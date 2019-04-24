<?php
/**
 * @var $model \app\models\Activity
 * @var $this \yii\web\View
 */
?>

<?php if (!empty($model->activityId)) {
    echo '<h3>'.\yii\helpers\Html::encode($model->title).'</h3>';

    echo \yii\widgets\DetailView::widget([
        'model' => $model,
        'attributes' => [
            'description:html',
            'startDate:date',
            'email:email',
            'isBlocking:boolean',
            'isRepeat:boolean',
            'repeatCount:html',
            'repeatInterval:integer',
        ],
    ]);

    foreach ($model->files as $file) {
        echo \yii\helpers\Html::img('/images/'.$file,['width'=>200, 'alt'=>'no activity image']);
    }


    echo '<br>'.\yii\bootstrap\Html::a('Редактировать',['/activity/edit','activityId'=>$model->activityId], ['class' => 'btn btn-primary']);
}?>
<br>
<br>
<?= \yii\bootstrap\Html::a('В календарь',['/day'], ['class' => 'btn btn-warning'])?>
