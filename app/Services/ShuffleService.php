<?php
namespace App\Services;

use App\Exceptions\ServiceException;
use App\Libs\MessageCode;
use App\Libs\Util;
use App\Models\ToolsModel;
use System\Application;

class ShuffleService{


    public static function Create($data){
        if (empty($data['text'])){
            throw new ServiceException(MessageCode::INVALID_TEXT);
        }
        if(mb_strlen($data['text']) > 1024){
            throw new ServiceException(MessageCode::INVALID_LEN_OUT);
        }

        $strArr = explode("\n", $data['text']);
        shuffle($strArr);
        return $strArr;
    }




}