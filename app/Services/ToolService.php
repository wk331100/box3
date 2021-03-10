<?php
namespace App\Services;

use App\Models\ToolsModel;

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

    public static function Execute(){

    }

}