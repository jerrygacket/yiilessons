<?php


namespace app\commands;


use app\components\NotifyComponent;
use yii\console\Controller;

class NotifyController extends Controller
{
    public $first;
    public $from;

    public function options($actionID)
    {
        return ['from'];
    }

    public function optionAliases()
    {
        return ['f'=>'from'];
    }

    public function actionSend() {
        if (empty($this->from)){
            $this->from = date('Y-m-d');
        }

        $activities = \Yii::$app->activity->getActivityNotification($this->from);

        if (count($activities) < 1) {
            echo 'no activities'.PHP_EOL;
            \Yii::$app->end();
        }

        $notify = \Yii::createObject([
            'class'=>NotifyComponent::class,
            'mailer' => \Yii::$app->mailer
        ]);

        $notify->sendNotification($activities);
    }
}