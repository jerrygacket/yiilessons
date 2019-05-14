<?php


namespace app\commands;


use yii\console\Controller;

class NotifyController extends Controller
{
    public $first;

    public function options($actionID)
    {
        return ['first'];
    }

    public function optionAliases()
    {
        return ['f'=>'first'];
    }

    public function actionSend() {
        echo 'ok send '.$this->first.PHP_EOL;
    }
}