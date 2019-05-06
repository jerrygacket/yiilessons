<?php


namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\DayIndexAction;

class DayController extends BaseController
{

    public function actions()
    {
        return [
            'index'=>['class'=>DayIndexAction::class,'rbac'=>$this->getRbac()],
        ];
    }

}