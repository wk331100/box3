<?php

namespace App\Models;

use System\DB;
use System\DB\DBMysql;

class LinkModel extends DB  {

    protected $table = 'link';
    private static $_instance;
    protected $_pk = 'id';


    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getTypeList(){
        return DBMysql::table($this->table)->select(['type'])->where(["enabled" => '1'])->groupBy("type")->get();
    }

    public function getActiveList(){
        return DBMysql::table($this->table)->where(["enabled" => '1'])->orderByDesc('top')->get();
    }

}