<?php
/**
 * @var $model \app\models\Activity
 * @var $this \yii\web\View
 */
?>

<h3><?=\yii\helpers\Html::encode($model->title)?></h3>
<p><strong>Описание:</strong> <?=$model->description?></p>

<p><?=\yii\helpers\Html::img('/images/'.$model->file,['width'=>200])?></p>