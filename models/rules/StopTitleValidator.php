<?php


namespace app\models\rules;


use app\components\DayComponent;
use app\models\Day;
use yii\validators\Validator;

class StopTitleValidator extends Validator
{
    public $letters=[];

    /**
     * @param \yii\base\Model $model Activity
     * @param string $attribute
     * @throws \yii\base\InvalidConfigException
     */
    public function validateAttribute($model, $attribute)
    {
        if($model->$attribute=='admin'){
            $model->addError($attribute,'Значение заголовка не допустимо');
        }

        $component = \Yii::createObject(['class' => DayComponent::class, 'nameClass' => Day::class]);

        $activities = $component->getActivities();
        foreach ($activities as $activity) {
            if ($activity->title == $model->$attribute) {
                $model->addError($attribute,'Событие с таким именем уже есть');
            }
        }
    }
}