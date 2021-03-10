<?php

namespace App\Models;

use System\DB;
use System\DB\DBMysql;

class ToolsModel extends DB  {

    protected $table = 'tools';
    private static $_instance;
    protected $_pk = 'id';


    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getTopList(){
        return DBMysql::table($this->table)->orderByDesc("top")->take(10)->get();
    }

    public function getActiveList(){
        return DBMysql::table($this->table)->where(["enabled" => '1'])->get();
    }

}