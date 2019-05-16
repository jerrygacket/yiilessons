<?php
/**
 * @var $model \app\models\Calendar
 * @var $provider \yii\data\ActiveDataProvider
 * @var $this \yii\web\View
 */
?>
<div class="row">
    <div class="col-md-2">
        <h3>Месяцы</h3>
        <?php
        echo '<ul>';
        foreach (\app\models\Calendar::MONTH_NAMES as $number=>$name) {
            echo '<li>';
            echo ' ' . \yii\bootstrap\Html::a($name, ['/calendar', 'month' => $number], ['class' => 'btn btn-success']);
            echo '</li>';
        }
        echo '</ul>';
        ?>
    </div>

    <div class="col-md-8">
        <h3>Месяц <?php echo $model->title?></h3>
        <p></p>
        <h4>Предыдущая страница</h4>
        <p><?php echo \Yii::$app->session->get('page_url','no pages').PHP_EOL;?></p>


            <?=\yii\grid\GridView::widget([
                'dataProvider' => $provider,
//                        'filterModel' => $model,
                'tableOptions' => [
                    'class' => 'table table-bordered table-hover'
                ],
                'rowOptions' => function($model,$key,$index,$grid) {
                    $class = $index%2?'odd':'even';
                    return ['class'=>$class,'key'=>$key,'index'=>$index];
                },
                'layout' => "{summary}\n{pager}\n{items}\n{pager}",
                'columns' => [
                    ['class'=>\yii\grid\SerialColumn::class,],
                    [
                        'attribute' => 'title',
                        'value' => function($model) {
                            return \yii\bootstrap\Html::a(\yii\bootstrap\Html::encode($model->title), ['/activity','activityId'=>$model->id]);
                        },
                        'format' => 'html',
                    ],
                    'dateStart',
                    'dateEnd',
                    'email',
                    [
                        'attribute' => 'user.email',
                        'label' => 'Емаил пользователя'
                    ],
                    [
                        'label' => 'Управление',
                        'format' => 'html',
                        'value' => function($model) {
                            return \yii\bootstrap\Html::a('Править',['/activity/edit','activityId'=>$model->id], ['class' => 'btn btn-warning']);
                        },
                    ]
                ]
            ])
            ?>

        <?= \yii\bootstrap\Html::a('Создать',['/activity/create'], ['class' => 'btn btn-success'])?>
    </div>

    <div class="col-md-2">
        <?php
        echo '<h3>Дни</h3>';
        echo '<ul>';
        for ($i = 1; $i <= $model->days; $i++) {
            echo '<li>';
            echo ' ' . \yii\bootstrap\Html::a('День '.$i, ['/day', 'date' => date('Y').'-'.$model->number.'-'.sprintf('%02d', $i)], ['class' => 'btn btn-success']);
            echo '</li>';
        }
        echo '</ul>';
        ?>
    </div>
</div>

