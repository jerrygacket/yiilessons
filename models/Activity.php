<?php

namespace app\models;


use yii\base\Model;

class Activity extends Model
{
    public $title;
    public $description;
    public $startDate;

    public $isBlocking;

    public $isRepeat;
    public $repeatCount;
    public $repeatInterval;

    public function rules()
    {
        return [
            ['title','required'],
            ['description','string','min' => 10],
            ['startDate','string'],
            ['isBlocking','boolean'],
            ['isRepeat','boolean'],
            ['repeatCount','number','integerOnly' => true,'min' => 0],
            ['repeatInterval','number','integerOnly' => true,'min' => 0],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'description' => 'Описание',
            'startDate' => 'Дата начала',
            'isBlocking' => 'Блокирующее',
            'isRepeat' => 'Повторять',
            'repeatCount' => 'Количество повторов',
            'repeatInterval' => 'Почторять через, с',
        ];
    }
}