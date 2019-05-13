<?php


namespace app\controllers\actions;

use app\components\ActivityComponent;
use app\models\Activity;
use yii\base\Action;
use yii\bootstrap\ActiveForm;
use yii\web\HttpException;
use yii\web\Response;

class ActivityCreateAction extends Action
{

    /**
     * @var RbacComponent
     */
    public $rbac;

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     * @var ActivityComponent $component
     * @var $model Activity
     */
    public function run()
    {
        //$model = \Yii::$app->activity->getModel();
        $model = \Yii::$app->activity->getModel(\Yii::$app->request->get('activityId'));
        $component = \Yii::createObject(['class' => ActivityComponent::class, 'nameClass' => Activity::class]);

        if (!$this->rbac->canCreateActivity($model)){
            //throw new HttpException(403,'No access to create activity')
            return \Yii::$app->runAction('auth/signin');
        }

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format=Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            if ($component->createActivity($model)) {
                return $this->controller->render('index',['model'=>$model]);
            }
        }

        return $this->controller->render('create', ['model' => $model]);
    }
}