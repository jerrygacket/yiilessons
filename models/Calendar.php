<?php


namespace app\models;


use yii\base\Model;

class Calendar extends Model
{
    const MONTH_NAMES = [
        '01'=>'Январь',
        '02'=>'Февраль',
        '03'=>'Март',
        '04'=>'Апрель',
        '05'=>'Май',
        '06'=>'Июнь',
        '07'=>'Июль',
        '08'=>'Август',
        '09'=>'Сентябрь',
        '10'=>'Октябрь',
        '11'=>'Ноябрь',
        '12'=>'Декабрь',
        ];

    public $title;
    public $number;
    public $days;
    public $activities;

    public function rules()
    {
        return [
            ['title','required'],
            ['number','required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Имя',
            'number' => 'Номер',
        ];
    }
}