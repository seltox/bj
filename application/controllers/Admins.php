<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 19.05.2020
 * Time: 15:46
 */

namespace application\controllers;


use application\components\Auth;
use application\components\Helpers;
use application\components\Template;

class Admins
{
    public function loginAction() {

        if(Helpers::isPost() and Auth::getInstance()->validate($_POST)) {
            Auth::getInstance()->setSession();
            Helpers::redirect('/tasks/index');
        }

        return Template::getInstance()->display('admins/login');
    }

    public function logoutAction() {
        Auth::getInstance()->unsetSession();
        Helpers::redirect('/tasks/index');
    }
}