<?php

namespace App\Libs;

class RedisKey
{
    //用户登陆Token
    const CONFIG_KEY                = "app:config:key";
    const LOGIN_TOKEN_USER          = "app:login:token:%s";
    const CLIENT_REQUEST_KEY        = "request:%s:%s";


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
}