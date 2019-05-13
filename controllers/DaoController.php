<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.04.19
 * Time: 10:03
 */

namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\DaoIndexAction;


class DaoController extends BaseController
{
    public function actions()
    {
        return [
            'dao'=>['class'=>DaoIndexAction::class],
            'index'=>['class'=>DaoIndexAction::class],
        ];
    }
}