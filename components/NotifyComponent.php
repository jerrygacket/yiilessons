<?php


namespace app\components;


use app\models\Activity;
use yii\base\Component;
use yii\mail\MailerInterface;

class NotifyComponent extends Component
{
    /**
     * @var MailerInterface
     */
    public $mailer;

    /**
     * @var $activity Activity
     */
    public function sendNotification ($activities) {
        foreach ($activities as $activity) {
            if ($this->mailer->compose('activity',['model'=>$activity])
                ->setFrom('timmykry@yandex.ru')
                ->setTo($activity->email)
                ->setSubject('Уведомление об активностях на сегодня')
                ->send()){
                echo 'email to '.$activity->email.PHP_EOL;
            }
        }
    }
}