<?php


namespace app\commands;


use app\components\NotifyComponent;
use app\models\Activity;
use yii\console\Controller;
use yii\data\ActiveDataProvider;

class NotifyController extends Controller
{
    public $first;
    public $from;
    public $userId;
    public $email;

    public function options($actionID)
    {
        return ['from','userId','email'];
    }

    public function optionAliases()
    {
        return ['f'=>'from','u'=>'userId','e'=>'email'];
    }

    /**
     * @var $provider ActiveDataProvider
     */
    public function actionSend() {
        if (empty($this->from)){
            $this->from = date('Y-m-d');
        }

        $provider = \Yii::$app->activity->getActivityNotification($this->from,$this->userId,$this->email);

        $activities = $provider->getModels();

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