<?php

namespace App\Models;

use System\DB;
use System\DB\DBMysql;

class FeedbackModel extends DB  {

    protected $table = 'feedback';
    private static $_instance;
    protected $_pk = 'id';


    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getTodaySubmitCount($clientIP){
        $result = DBMysql::table($this->table)->where(['client_ip' => $clientIP])
            ->where('create_time','>' , date('Y-m-d' . ' 00:00:00'))->count();
        return $result->count;
    }

}