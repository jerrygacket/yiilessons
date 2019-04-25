<?php

namespace app\models;


use app\models\rules\isRepeatValidator;
use app\models\rules\StopTitleValidator;
use yii\base\Model;

class Activity extends Model
{
    public $activityId = null;
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

    public $file;
    public $files = [];
    public $uploadedFiles = [];

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
            ['title','trim'],
            [['title'],StopTitleValidator::class],

            ['description','match', 'pattern' => '/^[a-z]{10,16}$/', 'message'=>'Не менее 10 и не более 16 МАЛЕНЬКИХ ЛАТИНСКИХ букв. Никаких цифр, пробелов и прочего.'],

            ['startDate','date','format' => 'php:Y-m-d'],
            ['startDate','match', 'pattern' => '/^[0-9]{2}.[0-9]{2}.[0-9]{4}$/', 'message'=>'Неправильная дата. Дата должна быть в формате дд.мм.гггг'],
            ['startDate','required'],

            [['isBlocking','useNotification','isRepeat'],'boolean'],

            ['email','email','message' => 'Емелй не прошел валидацию'],
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
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'description' => 'Описание',
            'startDate' => 'Дата начала',
            'useNotification' => 'Уведомлять',
            'emailRepeat' => 'Email еще раз',
            'isBlocking' => 'Блокирующее',
            'isRepeat' => 'Повторять',
            'repeatCount' => 'Количество повторов',
            'repeatInterval' => 'Почторять через, с',
            'uploadedFiles' => 'Файлы',
        ];
    }
}