<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 19.05.2020
 * Time: 13:32
 */

namespace application\components;


class Helpers
{
    static function redirect($url) {
        Header("Location: ".$url);
        exit;
    }

    static function isPost() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    static function encode($data) {
        return htmlspecialchars($data);
    }

    static function linkSort($current_sort, $current_sort_type, $currentPage, $field, $label) {
        return '<a href="/tasks/index?page='.intval($currentPage).'&sort='.$field.'&sort_type='.($current_sort == $field ? ($current_sort_type == 'desc' ? 'asc' : 'desc') : 'asc').'">'.$label.'</a>';
    }

    static function setFlashMessage($message) {
        $_SESSION['flashMessage'] = $message;
    }

    static function getFlashMessage() {
        if(isset($_SESSION['flashMessage']) and !empty($_SESSION['flashMessage'])) {
            $message = $_SESSION['flashMessage'];
            unset($_SESSION['flashMessage']);
            return $message;
        } else {
            return false;
        }
    }
}