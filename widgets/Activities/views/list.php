<?php
/**       * @var $this \yii\web\View
 * @var $model \app\models\Calendar
 */
?>

        <h4>Список дел</h4>
        <ul>
            <?php
            foreach ($model->activities as $activity) {
                echo '<li>'.$activity->title;
                echo ' '.\yii\bootstrap\Html::a('Посмотреть',['/activity','activityId'=>$activity->id], ['class' => 'btn btn-success']);
                echo ' '.\yii\bootstrap\Html::a('Редактировать',['/activity/edit','activityId'=>$activity->id], ['class' => 'btn btn-primary']);
                echo '</li>';
            }
            ?>
        </ul>


