<?php


namespace app\components;


use app\models\Day;
use yii\base\Component;

class DayComponent extends Component
{
    public $dayClass;

    public function init()
    {
        parent::init();

        if (empty($this->dayClass)){
            throw new \Exception('no day Class Name');
        }
    }

    /**
     * @return Day
     */
    public function getModel() {
        return new $this->dayClass;
    }
}