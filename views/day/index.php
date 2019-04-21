<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <?php
        /**
         * @var $this \yii\web\View
         * @var $model \app\models\Activity
         */
        ?>
        <div class="row">
            <div class="col-12">
                <h3>День недели</h3>
                <p><?php echo $model->title?></p>
                <h4>Предыдущая страница</h4>
                <p><?php echo \Yii::$app->session->get('page_url','no pages').PHP_EOL;?></p>
            </div>
        </div>
    </div>
</div>
