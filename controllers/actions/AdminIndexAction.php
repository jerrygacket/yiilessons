<?php


namespace app\controllers\actions;


use app\components\ActivityComponent;
use app\components\AuthComponent;
use app\components\RbacComponent;
use app\models\Activity;
use app\models\Users;
use yii\base\Action;

class AdminIndexAction extends Action
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
        $authComponent = \Yii::createObject(['class' => AuthComponent::class, 'nameClass' => Users::class]);
        $authModel = $authComponent->getModel();

        $activityComponent = \Yii::createObject(['class' => ActivityComponent::class, 'nameClass' => Activity::class]);
        $activityModel = $activityComponent->getModel();
        $activityProvider = $activityComponent->getDataProvider(\Yii::$app->request->queryParams);
//
//        if (!$this->rbac->canViewActivity($model)){
//            return \Yii::$app->runAction('auth/signin');
//            //throw new HttpException(403,'No access to create activity');
//        }

        return $this->controller->render(
            'index',
            [
                'authModel'=>$authModel,
                'activityModel'=>$activityModel,
                'activityProvider'=>$activityProvider
            ]
        );
    }
}