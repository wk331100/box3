<?php

namespace App\Models;

use System\DB;
use System\DB\DBMysql;

class UserModel extends DB  {

    protected $table = 'user';
    private static $_instance;
    protected $_pk = 'uid';


    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function checkPhoneExist($phone){
        if (empty(DBMysql::table($this->table)->where(['phone'=> $phone])->first())) {
            return false;
        }
        return true;
    }

    public function getInfoByPhone($phone){
        return DBMysql::table($this->table)->where(['phone'=> $phone])->first();
    }

    public function getSafeInfo($uid){
        $userInfo = $this->getInfo($uid);
        unset($userInfo->rand_char);
        unset($userInfo->password);
        return $userInfo;
    }
}