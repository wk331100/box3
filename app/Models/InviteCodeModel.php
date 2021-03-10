<?php

namespace App\Models;

use System\DB;
use System\DB\DBMysql;

class InviteCodeModel extends DB  {

    protected $table = 'invite_code';
    private static $_instance;
    protected $_pk = 'id';


    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function checkInviteCode($inviteCode){
        $where = [
            'invite_code'=> $inviteCode,
            'enabled' => 1
        ];
        if (empty(DBMysql::table($this->table)->where($where)->first())) {
            return false;
        }
        return true;
    }

}