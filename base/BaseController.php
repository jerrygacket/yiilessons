<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.04.19
 * Time: 18:54
 */
namespace app\base;

use yii\base\Action;
use yii\base\Component;
use yii\web\Controller;

class BaseController extends Controller
{

    protected function getRbac(){
        return \Yii::$app->rbac;
    }

    /**
     * @param $action Action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        //TODO: redirect to auth
        if(\Yii::$app->user->isGuest){
            //throw new HttpException(401,'Need authorization');
            return \Yii::$app->runAction('auth/signup');
        }
        return parent::beforeAction($action);
    }

    /**
     * @param \yii\base\Action $action
     * @param mixed $result
     * @return mixed
     */
    public function afterAction($action, $result)
    {
        $page = \Yii::$app->request->url; // так понятнее.
        \Yii::$app->session->set('page_url',$page);

        return parent::afterAction($action, $result); // TODO: Change the autogenerated stub
    }
}