<?php

namespace app\models;


use app\models\rules\StopTitleValidator;
use yii\base\Model;

class Activity extends Model
{
    public $title;
    public $description;
    public $startDate;

    public $email;
    public $emailRepeat;

    public $useNotification;



    public $isBlocking;

    public $isRepeat;
    public $repeatCount;
    public $repeatInterval;

    private $repeatCountList=[0=>'Не повторять',1=>'Один раз'];

    public function getRepeatCountList(){
        return $this->repeatCountList;
    }

    public function beforeValidate()
    {
        if(!empty($this->startDate)){
            $date=\DateTime::createFromFormat('d.m.Y',$this->startDate);
            if($date){
                $this->startDate=$date->format('Y-m-d');
            }
        }
        return parent::beforeValidate();
    }

    public function rules()
    {
        return [
            ['title','required'],
            ['description','string','min' => 10],
            ['title','trim'],
//            ['description','match','pattern' => '/[a-z]{1,}/iu'],
            ['startDate','date','format' => 'php:Y-m-d'],
            [['isBlocking','useNotification','isRepeat'],'boolean'],
            ['email','email','message' => 'Емелй не прошел валидацию'],
            ['emailRepeat','compare','compareAttribute'=>'email'],
            ['email','required','when' => function($model){
                return $model->useNotification==1;
            }],
//            ['title','stopTitle'],
            [['title'],StopTitleValidator::class,'letters' => [1,2]],
//            ['repeatCount','number','integerOnly' => true,'min' => 0],
            ['repeatCount','in','range' => array_keys($this->repeatCountList)],
            ['repeatInterval','number','integerOnly' => true,'min' => 0],
        ];
    }

    public function stopTitle($attr){
        if($this->$attr=='admin'){
            $this->addError('title','Значени заголовка не допустимо');
        }
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