<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.04.19
 * Time: 10:03
 */

namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\DaoCacheAction;
use app\controllers\actions\DaoIndexAction;
use yii\filters\PageCache;


class DaoController extends BaseController
{
    public function behaviors()
    {
        return [
            'class'=> PageCache::class,'only' => ['dao'],'duration' => 10
        ];
    }


    public function actions()
    {
        return [
            'dao'=>['class'=>DaoIndexAction::class],
            'index'=>['class'=>DaoIndexAction::class],
            'cache'=>['class'=>DaoCacheAction::class],
        ];
    }
}