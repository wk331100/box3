<?php

namespace App\Http\Middleware;

use App\Libs\MessageCode;
use App\Libs\RedisKey;
use App\Libs\Util;
use System\Redirect;
use System\Redis;
use System\Request;
use System\Response;

class BeforeMiddleware{

    public function handle(Request $request){
        $requestId = Util::randChar();
        $request->setParam('request_id', strtoupper($requestId));

        $ip = $request->input('ip');
        //检查用户请求频率
        $time = date("YmdHi");
        $clientKey = RedisKey::getClientKey($ip, $time);
        $redis = new Redis();
        $num = $redis->incr($clientKey);
        if ($num > 6){
            echo json_encode(Response::fake(MessageCode::FAKE_ERROR));
            die();
        }
    }



}