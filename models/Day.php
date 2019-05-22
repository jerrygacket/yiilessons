<?php


namespace app\models;


use yii\base\Model;

class Day extends Model
{
    public $title;
    public $isWork;
    public $activities;
    public $currentDate;

    public function rules()
    {
        return [
            ['title','required'],
            ['isWork','boolean'],
            ['activities','string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Имя',
            'isWork' => 'Рабочий день',
            'activities' => 'Задачи на день',
        ];
    }
}