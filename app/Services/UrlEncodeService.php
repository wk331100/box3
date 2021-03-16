<?php
namespace App\Services;

use App\Exceptions\ServiceException;
use App\Libs\MessageCode;
use App\Models\ToolsModel;
use System\Application;

class UrlEncodeService{

    public static function Encode($data){
        if (empty($data['text'])){
            throw new ServiceException(MessageCode::INVALID_TEXT);
        }
        return urlencode($data['text']);
    }

    public static function Decode($data){
        if (empty($data['text'])){
            throw new ServiceException(MessageCode::INVALID_TEXT);
        }
        return urldecode($data['text']);
    }

}