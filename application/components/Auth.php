<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 19.05.2020
 * Time: 13:52
 */

namespace application\components;


class Auth
{

    protected static $_instance;

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }


    protected $_adminsList = array(
        'admin' => '202cb962ac59075b964b07152d234b70'
    );

    protected $_error = '';

    public function validate($params) {
        if(empty($params['login']) or empty($params['password'])) {
            $this->_error = 'Укажите данные для авторизации';
            return false;
        } else {
            foreach($this->_adminsList as $login => $password) {
                if($params['login'] == $login and md5($params['password']) == $password) {
                    return true;
                }
            }

            $this->_error = 'Неверные данные для авторизации';
            return false;
        }
    }

    public function getError() {
        return $this->_error;
    }

    public function hasError() {
        return !empty($this->_error);
    }

    public function setSession() {
        $_SESSION['is_auth'] = true;
    }

    public function unsetSession() {
        unset($_SESSION['is_auth']);
    }

    public function isAdmin() {
        if(isset($_SESSION['is_auth']) and $_SESSION['is_auth'] == true) return true;
        return false;
    }

}