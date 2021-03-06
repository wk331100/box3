<?php

namespace App\Libs;

class RedisKey
{
    //用户登陆Token
    const CONFIG_KEY                = "box3:app:config:key";
    const LOGIN_TOKEN_USER          = "box3:app:login:token:%s";
    const CLIENT_REQUEST_KEY        = "box3:request:%s:%s";
    const ONLINE_USER               = "box3:online:%s";
    const VISIT                     = "box3:visit";
    const CLIENT_SUBMIT_KEY         = "box3:submit:%s";


    /**
     * 获取登录Token的uid
     * @param $token
     * @return string
     */
    public static function getLoginTokenUser($token) {
        return sprintf(self::LOGIN_TOKEN_USER, $token);
    }


    /**
     * 获取客户端请求key
     * @param $token
     * @return string
     */
    public static function getClientKey($ip, $time) {
        return sprintf(self::CLIENT_REQUEST_KEY, $ip, $time);
    }

    /**
     * 获取客户端提交key
     * @param $token
     * @return string
     */
    public static function getSubmitKey($ip) {
        return sprintf(self::CLIENT_SUBMIT_KEY, $ip);
    }

    /**
     * 获取客户端在线统计
     * @param $token
     * @return string
     */
    public static function getOnlineKey($ip) {
        return sprintf(self::ONLINE_USER, $ip);
    }
}