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

    public function getInfoByUrl($url){
        return DBMysql::table($this->table)->where(["url" => $url])->first();
    }

    public function getTopList(){
        return DBMysql::table($this->table)->where(["enabled" => '1'])->orderByDesc("top")->take(10)->get();
    }

    public function getActiveList(){
        return DBMysql::table($this->table)->where(["enabled" => '1'])->get();
    }

    public function getTypeList(){
        return DBMysql::table($this->table)->select(['type'])->where(["enabled" => '1'])->groupBy("type")->get();
    }
}