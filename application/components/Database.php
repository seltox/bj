<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 19.05.2020
 * Time: 14:53
 */

namespace application\components;


class Database
{
    protected static $_instance;
    protected $_res_id;

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    protected $_link;
    public function connect() {
        $this->_link = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($this->_link->connect_errno) {
            exit('DB CONNECT ERROR');
        }
    }

    public function query($query) {
        $this->_res_id = $this->_link->query($query);
        if(!$this->_res_id) die($this->_link->error.' in query:'.$query);
        return $this->_res_id;
    }

    protected function safe($data) {
        return $this->_link->escape_string($data);
    }

    protected function _compile_array($array, $char=',') {
        $return_array = array();
        foreach($array as $k=>$v) {
            $return_array[] = $this->_clear_field($k)." = '".$this->safe($v)."'";
        }
        return implode($char, $return_array);
    }

    public function insert($table, $array) {
        $this->query("insert into `$table` set ".$this->_compile_array($array));
    }


    public function delete($table, $array_where) {
        $this->query("delete from `$table` where ".$this->_compile_array($array_where, ' and '));
    }

    public function update($table, $array_set, $array_where) {
        if(is_integer($array_where)) {
            $where = "id = '$array_where'";
        } else {
            $where = $this->_compile_array($array_where, ' and ');
        }
        $this->query("update `$table` set ".$this->_compile_array($array_set)." where ".$where);
    }

    public function insertId() {
        return $this->_link->insert_id;
    }

    protected function _clear_field($field) {
        return "`".preg_replace("#[^\w\.\-]#", '', $field)."`";
    }
}