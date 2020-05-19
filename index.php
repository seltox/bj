<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 19.05.2020
 * Time: 11:39
 */
error_reporting(E_ALL);
ini_set('display_errors', 'on');


define('MAIN_DIR', dirname(__FILE__));

function init_auto_loader($className)
{
    $className = str_replace('\\', '/', $className);
    require_once MAIN_DIR . '/' . $className . '.php';
}

spl_autoload_register('init_auto_loader');

@session_start();

include MAIN_DIR.'/application/config/database.php';
\application\components\Database::getInstance()->connect();

$route = isset($_GET['r']) ? $_GET['r'] : 'tasks/index';

$routes = \application\components\Routes::getInstance();
$result = $routes->setRoute($route);

if($result === false) {
    $routes->is404();
}
$controllerClass = ucfirst($routes->getController());
$controllerClass =  "\application\controllers\\$controllerClass";
$action = $routes->getAction();
$action = $action."Action";

\application\components\Template::getInstance()->setTemplateDir('application/views');

$actionContent = '';
if(class_exists($controllerClass)) {
    $controller = new $controllerClass;

    if(method_exists($controller, $action)) {
        $actionContent = $controller->$action();
    } else {
        $routes->is404();
    }
} else {
    $routes->is404();
}

echo \application\components\Template::getInstance()->display('layout', array(
    'content' => $actionContent
));


