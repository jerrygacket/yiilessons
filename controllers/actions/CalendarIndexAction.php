<?php


namespace app\controllers\actions;


use app\components\CalendarComponent;
use app\components\RbacComponent;
use app\models\Calendar;
use yii\base\Action;

class CalendarIndexAction extends Action
{
    /**
     * @var RbacComponent
     */
    public $rbac;

    public function run(){
        $component = \Yii::createObject(['class' => CalendarComponent::class, 'nameClass' => Calendar::class]);
        $model = $component->getModel(\Yii::$app->request->queryParams);

        if (!$this->rbac->canViewActivity($model)){
            return \Yii::$app->runAction('auth/signin');
            //throw new HttpException(403,'No access to create activity');
        }

        $provider = $component->getDataProvider(\Yii::$app->request->queryParams,$model);

        return $this->controller->render('index',['model' => $model,'provider'=>$provider]);
    }
}