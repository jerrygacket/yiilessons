<?php


namespace app\controllers\actions;

use app\components\ActivityComponent;
use app\components\RbacComponent;
use app\models\Activity;
use app\models\ActivitySearch;
use yii\base\Action;
use yii\web\HttpException;

class ActivityIndexAction extends Action
{
    /**
     * @var RbacComponent
     */
    public $rbac;

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function run(){
        $component = \Yii::createObject(['class' => ActivityComponent::class, 'nameClass' => Activity::class]);
        $model = $component->getModel(\Yii::$app->request->queryParams);

        if (!$this->rbac->canViewActivity($model)){
            return \Yii::$app->runAction('auth/signin');
            //throw new HttpException(403,'No access to create activity');
        }

        return $this->controller->render('index',['model' => $model]);
    }
}