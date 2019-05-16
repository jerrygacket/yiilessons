<?php


namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\CalendarIndexAction;

class CalendarController extends BaseController
{
    public function actions()
    {
        return [
            'index'=>['class'=>CalendarIndexAction::class,'rbac'=>$this->getRbac()],
        ];
    }
}