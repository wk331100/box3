<?php
namespace App\Services;

use App\Libs\RedisKey;
use App\Models\ToolsModel;
use System\Redis;

class ToolService{

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
            'visit' => $redis->get(RedisKey::VISIT)
        ];
        return array_merge($data, $bindArray);
    }

}