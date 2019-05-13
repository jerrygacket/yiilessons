<?php


namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\AdminIndexAction;

class AdminController extends BaseController
{
    public function actions()
    {
        return [
            'index'=>['class'=>AdminIndexAction::class,'rbac'=>$this->getRbac()],
        ];
    }
}