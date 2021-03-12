<?php
namespace App\Services;

use App\Exceptions\ServiceException;
use App\Libs\MessageCode;
use App\Libs\Util;
use App\Models\ToolsModel;
use System\Application;

class RandCharService{

    const CHAR_UPPER = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const CHAR_LOWER = 'abcdefghijklmnopqrstuvwxyz';
    const NUMBER = '1234567890';
    const SPECIAL = '!@#$%^&*';

    public static function Create($data){
        if (empty($data['char'])){
            throw new ServiceException(MessageCode::INVALID_CHAR);
        }
        if (empty($data['len'])){
            throw new ServiceException(MessageCode::INVALID_LEN);
        }

        $char = self::parseChar(explode('|', $data['char']));

        return Util::makeCode($char, $data['len']);
    }


    public static function parseChar($charArray = []){
        $char = "";
        foreach ($charArray as $item){
            switch ($item){
                case "char_upper" : $char .= self::CHAR_UPPER; break;
                case "char_lower" : $char .= self::CHAR_LOWER; break;
                case "number" : $char .= self::NUMBER; break;
                case "special" : $char .= self::SPECIAL; break;
            }
        }
        return $char;
    }





}