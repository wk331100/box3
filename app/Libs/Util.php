<?php

namespace App\Libs;

class Util
{
    /**
     * 生成随机字符
     * @param int $length
     *
     * @return string
     */
    public static function randChar($length = 8) {
        return self::makeWebCode($length);
    }


    /**
     * 生成web随机码
     * @param int $num
     * @param int $length
     *
     * @return string
     */
    public static function makeWebCode($length = 16) {
        // 字符集
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $code;
    }

    /**
     * 生成随机码
     * @param int $num
     * @param int $length
     *
     * @return string
     */
    public static function makeCode($chars, $length = 16) {
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $code;
    }

    public static function checkPhoneNumber($phone) {
        //中国联通号码：130、131、132、145（无线上网卡）、155、156、185（iPhone5上市后开放）、186、176（4G号段）、175（2015年9月10日正式启用，暂只对北京、上海和广东投放办理）,166,146
        //中国移动号码：134、135、136、137、138、139、147（无线上网卡）、148、150、151、152、157、158、159、178、182、183、184、187、188、198
        //中国电信号码：133、153、180、181、189、177、173、149、199
        $g = "/^1[34578]\d{9}$/";
        $g2 = "/^19[89]\d{8}$/";
        $g3 = "/^166\d{8}$/";
        if (preg_match($g, $phone)) {
            return true;
        } else if (preg_match($g2, $phone)) {
            return true;
        } else if (preg_match($g3, $phone)) {
            return true;
        }
        return false;
    }



}