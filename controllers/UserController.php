<?php


namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\UserIndexAction;

class UserController extends BaseController
{
    public function actions()
    {
        return [
            'index'=>['class'=>UserIndexAction::class,'rbac'=>$this->getRbac()],
        ];
    }
}