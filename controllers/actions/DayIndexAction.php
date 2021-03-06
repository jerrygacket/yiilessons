<?php


namespace app\controllers\actions;


use app\components\DayComponent;
use app\models\Day;
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
        $component = \Yii::createObject(['class' => DayComponent::class, 'nameClass' => Day::class]);
        $model = $component->getModel(\Yii::$app->request->queryParams);

        if (!$this->rbac->canViewActivity($model)){
            return \Yii::$app->runAction('auth/signin');
            //throw new HttpException(403,'No access to create activity');
        }

        $provider = $component->getDataProvider(\Yii::$app->request->queryParams,$model);

        return $this->controller->render('index',['model' => $model, 'provider' => $provider]);
    }
}