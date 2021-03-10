<?php

namespace System;

use App\Libs\MessageCode;

class Redirect{

    public static function to($url, $params = []){
        if (!empty($params)) {
            $url .= "?" . http_build_query($params);
        }
        header("Location: " . $url);
        exit();
    }




}