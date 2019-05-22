<?php


namespace app\controllers\actions;


use app\components\RbacComponent;
use app\components\UserComponent;
use app\models\Users;
use yii\base\Action;
use yii\bootstrap\ActiveForm;
use yii\web\Response;

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


        if (!$this->rbac->canViewProfile($model)){
            return \Yii::$app->runAction('auth/signin');
            //throw new HttpException(403,'No access to create activity');
        }

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format=Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            if ($component->saveUser($model)) {
                $model = $component->getModel();
            }
        }

        return $this->controller->render('index',['model' => $model]);
    }
}