<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 19.05.2020
 * Time: 11:40
 */

namespace application\models;

use application\components\Auth;
use application\components\Database;
use application\components\Helpers;

class Tasks
{

    protected $_errors = array();
    protected $_fields = array(
        'name' => array(
            'required',
        ),
        'email' => array(
            'required',
            'email'
        ),
        'text' => array(
            'required',
        ),
        'status' => array(
            'int'
        )
    );

    protected $_data;



    public function validate($params) {
        $new_data = array();

        foreach($this->_fields as $field => $filters) {
            foreach($filters as $filter) {
                if($filter == 'required' and empty($params[$field])) {
                    $this->addError("Не указано обязательное поле: ".$this->labels($field));
                }

                if($filter == 'email' and !empty($params[$field]) and !filter_var($params[$field], FILTER_VALIDATE_EMAIL)) {
                    $this->addError("Поле: ".$this->labels($field)." не является E-mail адресом");
                }

                if($filter == 'int') {
                    $params[$field] = isset($params[$field]) ? intval($params[$field]) : 0;
                }
            }
            $new_data[$field] = $params[$field];
        }

        $this->_data = $new_data;

        return !$this->hasErrors();
    }

    public function getTask($id) {
        $id = intval($id);
        $query = Database::getInstance()->query("select * from tasks where id='$id'");
        $this->_data = $query->fetch_assoc();
    }

    public function getList($limit, $offset, $sort, $sort_type) {

        if(($sort != 'id' and !in_array($sort, array_keys($this->_fields))) or !in_array($sort_type, array('desc', 'asc'))) {
            exit;
        }

        $query = "select * from tasks order by $sort $sort_type limit $offset,$limit ";
        $query = Database::getInstance()->query($query);
        $rows = array();

        while($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function countAll() {
        $query = Database::getInstance()->query("select count(*) as count_records from tasks");
        $arr = $query->fetch_assoc();
        return $arr['count_records'];
    }

    public function getField($field) {
        return isset($this->_data[$field]) ? $this->_data[$field] : '';
    }

    public function addError($error) {
        $this->_errors[] = $error;
    }

    public function hasErrors() {
        return count($this->_errors);
    }

    public function getErrors() {
        return $this->_errors;
    }

    public function labels($field=false) {
        $labels = array(
            'name' => 'Имя',
            'email' => 'E-mail',
            'text' => 'Текст'
        );

        return $field === false ? $labels : $labels[$field];
    }

    public function save($id=false) {
        if($id) {
            if(!Auth::getInstance()->isAdmin()) {
                Helpers::redirect('/admins/login');
            }

            $oldRow = Database::getInstance()->query("select * from tasks where id='".intval($id)."'");
            $oldRow = $oldRow->fetch_assoc();

            if($oldRow['text'] != $this->_data['text']) {
                $this->_data['is_edit_admin'] = 1;
            }

            Database::getInstance()->update('tasks', $this->_data, $id);
            return $id;
        } else {
            Database::getInstance()->insert('tasks', $this->_data);
            return Database::getInstance()->insertId();
        }

    }
}