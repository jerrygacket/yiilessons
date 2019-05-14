<?php


namespace app\widgets\Activities;


use yii\bootstrap\Widget;

class ActivityTableWidget extends Widget
{
    public $model;

    public function run()
    {
        return $this->render('list',['model' => $this->model]);
    }
}