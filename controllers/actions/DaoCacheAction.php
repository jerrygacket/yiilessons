<?php


namespace app\controllers\actions;


use yii\base\Action;

class DaoCacheAction extends Action
{
    public function run()
    {
        \Yii::$app->cache->set('first','firstValue');

        $first = \Yii::$app->cache->get('first');

        echo $first.PHP_EOL;
    }
}