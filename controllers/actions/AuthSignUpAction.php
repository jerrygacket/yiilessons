<?php


namespace app\controllers\actions;

use app\components\AuthComponent;
use app\models\Users;
use yii\base\Action;

class AuthSignUpAction extends Action
{
    public function run(){
        $component = \Yii::createObject(['class' => AuthComponent::class, 'nameClass' => Users::class]);
        $model = $component->getModel();

        if(\Yii::$app->request->isPost){
            $model->load(\Yii::$app->request->post());
            if($component->createUser($model)){
                return $this->controller->redirect(['/auth/signin']);
            }
        }

        return $this->controller->render('signup',['model'=>$model]);
    }
}