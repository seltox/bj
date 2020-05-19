<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 19.05.2020
 * Time: 11:59
 */

namespace application\controllers;

use application\components\Helpers;
use application\components\Template;

class Tasks
{
    public function indexAction() {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
        $sort_type = isset($_GET['sort_type']) ? $_GET['sort_type'] : 'desc';
        $limit = 3;
        $offset = ($page - 1) * $limit;
        $model = new \application\models\Tasks();
        $rows = $model->getList($limit, $offset, $sort, $sort_type);
        $countPages = ceil($model->countAll() / $limit);

        return Template::getInstance()->display('tasks/index', array(
            'rows' => $rows,
            'sort' => $sort,
            'sort_type' => $sort_type,
            'countPages' => $countPages,
            'currentPage' => $page
        ));
    }

    public function manageAction() {

        if(isset($_GET['id'])) {
            $model = new \application\models\Tasks();
            $model->getTask($_GET['id']);
        } else {
            $model = new \application\models\Tasks();
        }


        if(Helpers::isPost() and $model->validate($_POST)) {
            $id = $model->save(isset($_GET['id']) ? intval($_GET['id']) : false);
            Helpers::setFlashMessage('Новость успешно '.(isset($_GET['id']) ? 'отредактирована' : 'добавлена'));
            if(!isset($_GET['id'])) {
                Helpers::redirect('/tasks/manage?id='.intval($id));
            }
        }

        return Template::getInstance()->display('tasks/manage', array(
            'isNewRecord' => !isset($_GET['id']),
            'model' => $model
        ));
    }
}