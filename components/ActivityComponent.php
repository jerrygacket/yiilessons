<?php


namespace app\components;


use app\models\Activity;
use yii\base\Component;

class ActivityComponent extends Component
{
    public $activityClass;

    public function init()
    {
        parent::init();

        if (empty($this->activityClass)){
            throw new \Exception('no activity ClassName');
        }
    }

    /**
     * @return Activity
     */
    public function getModel() {
        return new $this->activityClass;
    }

    /**
     * @param $model Activity
     * @return bool
     */
    public function createActivity(&$model):bool{
        if (!$model->validate()) {
            print_r($model->getErrors());

            return false;
        }

        return true;
    }
}