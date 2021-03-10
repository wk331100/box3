<?php

namespace App\Models;

use System\DB;
use System\DB\DBMysql;

class LevelModel extends DB  {

    protected $table = 'level';
    private static $_instance;
    protected $_pk = 'id';


    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getMaxLevel(){
        $info = DBMysql::table($this->table)->orderByDesc($this->_pk)->first();
        return $info->id;
    }

}