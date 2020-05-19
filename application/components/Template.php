<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 19.05.2020
 * Time: 11:46
 */

namespace application\components;


class Template
{
    protected static $_instance;

    protected $_dir = '';

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    public function setTemplateDir($dir) {
        $this->_dir = $dir;
    }


    public function display($template, $params=array()) {
        extract($params, EXTR_PREFIX_SAME, 'data');

        ob_start();
        ob_implicit_flush(false);
        require($this->_dir.'/'.$template.'.php');
        return ob_get_clean();
    }
}