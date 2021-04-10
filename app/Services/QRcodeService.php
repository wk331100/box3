<?php
namespace App\Services;

use App\Exceptions\ServiceException;
use App\Libs\MessageCode;
use App\Libs\Util;
use App\Models\ToolsModel;
use System\Application;

class QRcodeService{


    public static function Create($data){
        if (empty($data['text'])){
            throw new ServiceException(MessageCode::INVALID_TEXT);
        }
        if(mb_strlen($data['text']) > 1024){
            throw new ServiceException(MessageCode::INVALID_LEN_OUT);
        }

        include APP_PATH . '/Libs/phpqrcode/phpqrcode.php';
        $errorCorrectionLevel = 'L';//容错级别
        $matrixPointSize = 10;//生成图片大小

        //生成二维码图片
        $randChar = Util::randChar();
        $imageName = IMG_PATH . '/qrcode ' . $randChar . ' .png';
        \QRcode::png($data['text'], $imageName, $errorCorrectionLevel, $matrixPointSize, 2);
        return $imageName;
    }



}