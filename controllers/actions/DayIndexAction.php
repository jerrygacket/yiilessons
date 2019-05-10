<?php


namespace app\controllers\actions;


use yii\base\Action;
use app\components\RbacComponent;

class DayIndexAction extends Action
{
    /**
     * @var RbacComponent
     */
    public $rbac;

    /**
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
    public function run(){
        $model = \Yii::$app->day->getModel();

        return $this->controller->render('index',['model' => $model]);
    }
}