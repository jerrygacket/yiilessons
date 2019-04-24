<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.04.19
 * Time: 18:53
 */

namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\ActivityCreateAction;
use app\controllers\actions\ActivityEditAction;
use app\controllers\actions\ActivityIndexAction;

class ActivityController extends BaseController
{
    public function actions()
    {
        return [
            'create'=>['class'=>ActivityCreateAction::class],
            'new'=>['class'=>ActivityCreateAction::class],
            'index'=>['class'=>ActivityIndexAction::class],
            'edit'=>['class'=>ActivityCreateAction::class],
        ];
    }
}