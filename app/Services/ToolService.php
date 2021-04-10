<?php
namespace App\Services;

use App\Libs\RedisKey;
use App\Models\ToolsModel;
use System\Redis;

class ToolService{

    const META_DESC = 'Box3.cc是一个简约的工具箱，为站长和互联网从业者提供免费的工具，我们的工具有在线Base64工具,在线加密工具,随机密码,二维码生成,代码格式化工具,正则工具等';

    public static function getToolList(){
        return ToolsModel::getInstance()->getActiveList();
    }

    public static function getToolMetaKey(){
        $list = self::getToolList();
        $keyArr = [];
        foreach ($list as $item){
            $keyArr[] = $item->desc;
        }
        return implode(',', $keyArr);
    }

    public static function getTypeList(){
        return ToolsModel::getInstance()->getTypeList();
    }

    public static function checkInList($key, $list){
        foreach ($list as $item){
            if( $key == $item->title) {
                return true;
            }
        }
        return false;
    }

    public static function getToolArray(){
        $list = ToolsModel::getInstance()->getActiveList();
        $toolArray = [];
        if(!empty($list)){
            foreach ($list as $item){
                $toolArray[] = $item->title;
            }
        }
        return $toolArray;
    }

    public static function buildEncode($url, $request){
        $toolInfo = ToolsModel::getInstance()->getInfoByUrl($url);
        $top = ToolsModel::getInstance()->getTopList();
        $data = [
            'title' => $toolInfo->title,
            'desc' => $toolInfo->desc,
            'list' => $top,
            'meta_key' => $toolInfo->meta_key,
            'meta_desc' => $toolInfo->meta_desc,
            'in_list' => ToolService::checkInList($toolInfo->title, $top)
        ];

        return self::bindExtData($data, $request);
    }

    public static function bindExtData($data, $request){
        $ip = $request->input('ip');
        $redis = new  Redis();
        $bindArray = [
            'client_ip' => $ip,
            'online_users' => $redis->scount("online:*", 100000000),
            'visit' => $redis->get(RedisKey::VISIT),
        ];
        return array_merge($data, $bindArray);
    }

}