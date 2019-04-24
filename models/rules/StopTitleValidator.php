<?php


namespace app\models\rules;


use app\components\DayComponent;
use app\models\Day;
use yii\validators\Validator;

class StopTitleValidator extends Validator
{
    public $letters=[];

    public function validateAttribute($model, $attribute)
    {
        if($model->$attribute=='admin'){
            $model->addError($attribute,'Значение заголовка не допустимо');
        }

        $component = \Yii::createObject(['class' => DayComponent::class, 'dayClass' => Day::class]);

        $activities = $component->getActivities();
        foreach ($activities as $activity) {
            if ($activity->title == $model->$attribute) {
                $model->addError($attribute,'Событие с таким именем уже есть');
            }
        }
    }
}