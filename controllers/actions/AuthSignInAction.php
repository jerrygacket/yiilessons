<?php


namespace app\controllers\actions;

use app\components\AuthComponent;
use app\models\Users;
use yii\base\Action;

class AuthSignInAction extends Action
{
    public $model;

    public function run(){
        $component = \Yii::createObject(['class' => AuthComponent::class, 'nameClass' => Users::class]);
        $model = $component->getModel();

        if(\Yii::$app->request->isPost){
            $model->load(\Yii::$app->request->post());
            if($component->authUser($model)){
                return $this->controller->redirect(['/day']);
            }
        }

        return $this->controller->render('signin',['model'=>$model]);
    }
}