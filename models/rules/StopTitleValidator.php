<?php


namespace app\models\rules;


use yii\validators\Validator;

class StopTitleValidator extends Validator
{
    public $letters=[];

    public function validateAttribute($model, $attribute)
    {
        if($model->$attribute=='admin'){
            $model->addError($attribute,'Значени заголовка не допустимо');
        }
    }
}