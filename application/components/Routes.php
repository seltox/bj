<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 19.05.2020
 * Time: 11:42
 */
namespace application\components;

class Routes
{
    protected static $_instance;

    protected $_route;
    protected $_controller;
    protected $_action;

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    public function setRoute($route) {
        if(empty($route)) {
            return false;
        }
        $this->_route = $route;
        $temp = explode('/', $route);
        $this->_controller = $temp[0];
        $this->_action = !empty($temp[1]) ? $temp[1] : 'index';
    }

    public function getController() {
        return $this->_controller;
    }

    public function getAction() {
        return $this->_action;
    }

    public function is404() {
        header('HTTP/1.1 404 Not Found');
        exit;
    }
}