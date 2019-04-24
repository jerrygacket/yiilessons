        <?php
        /**       * @var $this \yii\web\View
         * @var $model \app\models\Day
         */
        ?>
        <div class="row">
            <div class="col-12">
                <h3>День недели</h3>
                <p><?php echo $model->title?></p>
                <h4>Предыдущая страница</h4>
                <p><?php echo \Yii::$app->session->get('page_url','no pages').PHP_EOL;?></p>
                <h4>Список дел</h4>
                <ul>
                    <?php
                    //заготовка
                    foreach ($model->activities as $activity) {
                        echo '<li>'.$activity->title;
                        echo ' '.\yii\bootstrap\Html::a('Посмотреть',['/activity','activityId'=>$activity->activityId], ['class' => 'btn btn-success']);
                        echo ' '.\yii\bootstrap\Html::a('Редактировать',['/activity/edit','activityId'=>$activity->activityId], ['class' => 'btn btn-primary']);
                        echo '</li>';
                    }
                    ?>
                </ul>

                <?= \yii\bootstrap\Html::a('Создать',['/activity/create'], ['class' => 'btn btn-success'])?>
            </div>
        </div>
