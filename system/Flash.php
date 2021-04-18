<?php
namespace System;

class Flash {

    public static function set($key, $value){
        $_SESSION['FLASH'][$key] = $value;
    }

    public static function get($key) {
        $value = '';
        if (isset($_SESSION['FLASH'][$key])) {
            $value = $_SESSION['FLASH'][$key];
            unset($_SESSION['FLASH'][$key]);
        }
        return $value;
    }
}