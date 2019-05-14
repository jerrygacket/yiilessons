<?php
/**
 * @var $model \app\models\Activity
 * @var $this \yii\web\View
 * @var $provider \yii\data\ActiveDataProvider
 */
?>

<?php if (!empty($model->id)) {
    echo '<h3>'.\yii\helpers\Html::encode($model->title).'</h3>';

    echo \yii\widgets\DetailView::widget([
        'model' => $model,
        'attributes' => [
            'description:html',
            'dateStart:date',
            'email:email',
            'isBlocked:boolean',
            'isRepeat:boolean',
            'repeatCount:html',
            'repeatInterval:integer',
        ],
    ]);

    if (!empty($model->files) && is_array($model->files)){
        foreach ($model->files as $file) {
            echo \yii\helpers\Html::img('/images/'.$file,['width'=>200, 'alt'=>'no activity image']);
        }
    } else {
        echo '<p>Нет файлов</p>';
    }



    echo '<br>'.\yii\bootstrap\Html::a('Редактировать',['/activity/edit','activityId'=>$model->id], ['class' => 'btn btn-primary']);
}?>
<br>
<br>
<?= \yii\bootstrap\Html::a('В календарь',['/day'], ['class' => 'btn btn-warning'])?>
