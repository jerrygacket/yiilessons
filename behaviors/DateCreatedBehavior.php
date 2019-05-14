<?php


namespace app\behaviors;


use yii\base\Behavior;

class DateCreatedBehavior extends Behavior
{
    public $attributeName;

    public function getDateStart() {
        return \Yii::$app->formatter->asDate($this->owner->{$this->attributeName}, 'd.m.Y');
    }

    public function setUpdatedOnDate() {
        return \Yii::$app->formatter->asDate($this->owner->{$this->attributeName}, 'd.m.Y');
    }
}