<?php


namespace app\controllers\actions;

use yii\base\Action;

class ActivityIndexAction extends Action
{

    /**
     *
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function run(){
        $model = \Yii::$app->activity->getModel(\Yii::$app->request->get('activityId')); // TODO: возможно нужна проверка на пустой ИД

        return $this->controller->render('index',['model' => $model]);
    }
}