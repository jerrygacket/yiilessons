<?php

namespace app\models;

use app\behaviors\DateCreatedBehavior;
use app\models\rules\StopTitleValidator;

class Activity extends ActivityDB
{
//    public $id = null;
//    public $title;
//    public $description;
//    public $dateStart;
//
//    public $email;
    public $emailRepeat;

//    public $useNotification;
//
//    public $isBlocked;
//
//    public $isRepeat;
//    public $repeatCount;
//    public $repeatInterval;

//    public $file;
//    public $files = [];
    public $uploadedFiles = [];

    private $repeatCountList=[0=>'Не повторять',1=>'Один раз'];

    public function getRepeatCountList(){
        return $this->repeatCountList;
    }

    public function behaviors()
    {
        return [
            ['class' => DateCreatedBehavior::class,
            'attributeName' => 'created_on']
        ];
    }

    public function beforeValidate()
    {
        if(!empty($this->dateStart)){
            $dateStart=\DateTime::createFromFormat('d.m.Y',$this->dateStart);
        } else {
            $dateStart=\DateTime::createFromFormat('d.m.Y',date('d.m.Y'));
        }
        if($dateStart){
            $this->dateStart=$dateStart->format('d.m.Y');
        }

        if(!empty($this->dateEnd)){
            $dateEnd=\DateTime::createFromFormat('d.m.Y',$this->dateEnd);
        } else {
            $dateEnd=\DateTime::createFromFormat('d.m.Y',date('d.m.Y'));
        }

        if($dateEnd){
            $this->dateEnd=$dateEnd->format('d.m.Y');
        }

        return parent::beforeValidate();
    }

    public function rules()
    {
        return array_merge([
            ['title','required'],
            ['title','trim'],
            [['title'],StopTitleValidator::class],

            ['description','match', 'pattern' => '/^[a-z]{10,16}$/', 'message'=>'Не менее 10 и не более 16 МАЛЕНЬКИХ ЛАТИНСКИХ букв. Никаких цифр, пробелов и прочего.'],

            ['dateStart','required'],
            ['dateStart','match', 'pattern' => '/^[0-9]{2}.[0-9]{2}.[0-9]{4}$/', 'message'=>'Неправильная дата. Дата должна быть в формате d.m.Y'],
            ['dateStart','date','format' => 'php:d.m.Y'],

            ['dateEnd','required'],
            ['dateEnd','match', 'pattern' => '/^[0-9]{2}.[0-9]{2}.[0-9]{4}$/', 'message'=>'Неправильная дата. Дата должна быть в формате d.m.Y'],
            ['dateEnd','date','format' => 'php:d.m.Y'],

            ['dateEnd','compare','compareAttribute'=>'dateStart', 'operator'=>'>=', 'message' => 'Дата окончания не может быть раньше даты начала'],

            [['isBlocked','useNotification','isRepeat'],'boolean'],

            ['email','email','message' => 'Емейл не прошел валидацию'],
            [['email','emailRepeat'],'required','when' => function($model){
                return $model->useNotification == 1;
            }],
            ['emailRepeat','compare','compareAttribute'=>'email', 'operator'=>'==', 'message' => 'Емелй не совпадают'],

            ['uploadedFiles','file','extensions' => ['jpg','png','pdf'],'maxFiles' => 4],

            ['repeatCount','in','range' => array_keys($this->repeatCountList)],
            ['repeatCount','compare','compareValue'=>0,'operator'=>'>','when' => function($model){
                return $model->isRepeat == 1;
            }, 'message' => 'Нужно выбрать число повторов'],
            ['repeatInterval','compare','compareValue'=>0,'operator'=>'>','when' => function($model){
                return $model->isRepeat == 1;
            }, 'message' => 'Нужно выбрать интервал повторов'],
            ['repeatInterval','number','integerOnly' => true,'min' => 0],
        ], parent::rules());
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'description' => 'Описание',
            'dateStart' => 'Дата начала',
            'dateEnd' => 'Дата окончания',
            'useNotification' => 'Уведомлять',
            'emailRepeat' => 'Email еще раз',
            'isBlocked' => 'Блокирующее',
            'isRepeat' => 'Повторять',
            'repeatCount' => 'Количество повторов',
            'repeatInterval' => 'Почторять через, с',
            'uploadedFiles' => 'Файлы',
        ];
    }
}