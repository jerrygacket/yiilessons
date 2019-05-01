<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.04.19
 * Time: 10:10
 */

namespace app\controllers\actions;

use app\components\DaoComponent;
use yii\base\Action;

class DaoIndexAction extends Action
{
    public function run(){
        /** @var DaoComponent $comp */
        $comp=\Yii::createObject(['class'=>DaoComponent::class,
            'connection' =>\Yii::$app->db]);
        $comp->testInsert();
        $users=$comp->getAllUsers();
        $activityUser=$comp->getActivityUser(\Yii::$app->request->get('user',1));
        $activityNotification=$comp->getActivityNotification();
        $firstActivity=$comp->getFirstActivity();
        $countActivity=$comp->getCountActivity();
        return $this->controller->render('index',['users'=>$users,
            'activityNotification'=>$activityNotification,
            'activityUser'=>$activityUser,
            'firstActivity'=>$firstActivity,
            'countActivity'=>$countActivity]);
    }
}