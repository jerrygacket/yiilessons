<?php


namespace app\controllers\actions;


use app\components\RbacComponent;
use app\components\UserComponent;
use app\models\Users;
use yii\base\Action;

class UserIndexAction extends Action
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
        $component = \Yii::createObject(['class' => UserComponent::class, 'nameClass' => Users::class]);
        $model = $component->getModel();
        $provider = $component->getSingleDataProvider(\Yii::$app->request->queryParams);

        if (!$this->rbac->canViewProfile($model)){
            return \Yii::$app->runAction('auth/signin');
            //throw new HttpException(403,'No access to create activity');
        }

        return $this->controller->render('index',['model' => $model, 'provider' => $provider]);
    }
}