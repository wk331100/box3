<?php
namespace App\Services;

use App\Exceptions\ServiceException;
use App\Libs\MessageCode;
use App\Libs\Util;
use App\Models\ToolsModel;
use System\Application;

class TimeFormateService{


    public static function Encode($data){
        if (empty($data['text']) || !is_numeric($data['text'])){
            throw new ServiceException(MessageCode::INVALID_TEXT);
        }
        if(mb_strlen($data['text']) > 1024){
            throw new ServiceException(MessageCode::INVALID_LEN_OUT);
        }
        return date('Y-m-d H:i:s', $data['text']);
    }

    public static function Decode($data){
        if (empty($data['text'])){
            throw new ServiceException(MessageCode::INVALID_TEXT);
        }
        if(mb_strlen($data['text']) > 1024){
            throw new ServiceException(MessageCode::INVALID_LEN_OUT);
        }
        $timestamp = strtotime($data['text']);
        if (!$timestamp){
            throw new ServiceException(MessageCode::INVALID_TEXT);
        }
        return $timestamp;
    }


}