<?php


namespace app\components;


use app\models\Day;
use yii\helpers\FileHelper;

class DayComponent extends \app\base\BaseComponent
{

    /**
     * @return Day
     */
    public function getModel() {

        $day = new $this->nameClass;
        $day->activities = $this->getActivities();

        return $day;
    }

    public function getActivities($dayId=null){
        FileHelper::createDirectory(\Yii::getAlias('@webroot/activities'));
        $files = FileHelper::findFiles(\Yii::getAlias('@webroot/activities/'));
        $activities = [];
        foreach ($files as $jsonFile) {
            $activities[] = json_decode(file($jsonFile)[0]);
        }

        return $activities;
    }
}