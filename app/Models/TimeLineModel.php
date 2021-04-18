<?php

namespace App\Models;

use System\DB;
use System\DB\DBMysql;

class TimeLineModel extends DB  {

    protected $table = 'timeline';
    private static $_instance;
    protected $_pk = 'id';


    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getActiveList(){
        return DBMysql::table($this->table)->where(["enabled" => '1'])->orderByDesc('time')->get();
    }

}