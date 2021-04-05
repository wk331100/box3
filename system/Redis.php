<?php

namespace System;

use App\Exceptions\RedisException;

class Redis{
    private $_connector;

    function __construct($connect = 'default'){
        $this->conn($connect);
    }

    public function conn($connect){
        $config = require(ROOT_PATH . '/config/database.php');
        $redisConfig = $config['redis'][$connect];
        try {
            $redis = new \Redis();
            $redis->connect($redisConfig['host'], $redisConfig['port']);
            if (!empty($redisConfig['password'])) {
                $redis->auth($redisConfig['password']);
            }
            if($redis->ping()){
                $redis->select($redisConfig['database']);
            }else{
                echo 'connection failed';
            }
            $this->_connector = $redis;
        } catch (RedisException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function set($key, $val){
        $this->_connector->set($key, $val);
    }

    public function setex($key, $ttl, $val){
        $this->_connector->setex($key, $ttl, $val);
    }


    public function get($key){
        return $this->_connector->get($key);
    }

    public function incr($key){
        return $this->_connector->incr($key);
    }

    public function decr($key){
        $this->_connector->decr($key);
    }

    public function incrBy($key, $num){
        return $this->_connector->incrBy($key, $num);
    }

    public function decrBy($key, $num){
        $this->_connector->decr($key, $num);
    }

    public function del($key){
        $this->_connector->del($key);
    }

    public function hset($key, $field, $val){
        $this->_connector->hset($key, $field, $val);
    }

    public function hget($key, $field){
        $this->_connector->hget($key, $field);
    }

    public function scan($match, $count){
        $iterator = null;
        $items = [];
        while (true) {
            $keys = $this->_connector->scan($iterator, $match, $count);
            if ($keys === false) {//迭代结束，未找到匹配pattern的key
                return $items;
            }
            $items = array_merge($items, $keys);
        }
    }

    public function scount($match, $count){
        return count($this->scan($match, $count));
    }

}