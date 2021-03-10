<?php
namespace App\Services;

use App\Exceptions\ServiceException;
use App\Libs\MessageCode;
use App\Models\ToolsModel;
use System\Application;

class Base64Service{

    public static function Encode($data){
        if (empty($data['text'])){
            throw new ServiceException(MessageCode::INVALID_TEXT);
        }
        return base64_encode($data['text']);
    }

    public static function Decode($data){
        if (empty($data['text'])){
            throw new ServiceException(MessageCode::INVALID_TEXT);
        }
        return base64_decode($data['text']);
    }

}