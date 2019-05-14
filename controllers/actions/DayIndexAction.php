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
        $model = $component->getModel();
        $provider = $component->getDataProvider(\Yii::$app->request->queryParams);

        return $this->controller->render('index',['model' => $model, 'provider' => $provider]);
    }
}