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
        if($data['len'] > 1024){
            throw new ServiceException(MessageCode::INVALID_LEN_OUT);
        }
        $charItems = explode('|', $data['char']);

        //先随机出必包含的字符
        $mainChar = self::makeMainChar($charItems);
        $char = self::parseChar($charItems);
        //再从总随机包中随机出剩余字符
        $rest = Util::makeCode($char, $data['len'] - count($charItems));
        //将所有字符打乱
        $arr = str_split($mainChar . $rest);
        shuffle($arr);
        return implode($arr,'');
    }

    public static function makeMainChar($charArray = []){
        $char = "";
        foreach ($charArray as $item){
            switch ($item){
                case "char_upper" : $char .= Util::makeCode(self::CHAR_UPPER, 1); break;
                case "char_lower" : $char .= Util::makeCode(self::CHAR_LOWER, 1); break;
                case "number" : $char .= Util::makeCode(self::NUMBER, 1); break;
                case "special" : $char .= Util::makeCode(self::SPECIAL, 1); break;
            }
        }
        return $char;
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