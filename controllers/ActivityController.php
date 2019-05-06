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
use app\controllers\actions\ActivityIndexAction;

class ActivityController extends BaseController
{

    public function actions()
    {
        return [
            'create'=>['class'=>ActivityCreateAction::class,'rbac'=>$this->getRbac()],
            'new'=>['class'=>ActivityCreateAction::class,'rbac'=>$this->getRbac()],
            'index'=>['class'=>ActivityIndexAction::class,'rbac'=>$this->getRbac()],
            'edit'=>['class'=>ActivityCreateAction::class,'rbac'=>$this->getRbac()],
        ];
    }
}