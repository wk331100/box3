<?php

namespace System;

use System\DB\DBMysql;
class DB{

    protected $table = 'user';
    protected $_pk = 'id';


    public function getList(){
        return DBMysql::table($this->table)->get();
    }

    public function getInfo($id){
        return DBMysql::table($this->table)->where($this->_pk, $id)->first();
    }

    public function create($insertData){
        if (!isset($insertData['create_time'])) {
            $insertData['create_time'] = date('Y-m-d H:i:s');
        }
        return DBMysql::table($this->table)->create($insertData);
    }

    public function update($updateData, $id){
        return DBMysql::table($this->table)->where($this->_pk, $id)->update($updateData);
    }

    public function delete($id){
        return DBMysql::table($this->table)->where($this->_pk, $id)->delete($id);
    }

}