<?php


namespace app\controllers\actions;

use app\components\ActivityComponent;
use app\models\Activity;
use yii\base\Action;

class ActivityCreateAction extends Action
{

    /**
     * @var ActivityComponent $component
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function run(){
        $model = \Yii::$app->activity->getModel();
        $component = \Yii::createObject(['class'=>ActivityComponent::class,'activityClass' => Activity::class]);
        if(\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            if ($component->createActivity($model)){

            }

        }
        return $this->controller->render('create',['model' => $model]);
    }
}