        <?php
        /**       * @var $this \yii\web\View
         * @var $model \app\models\Day
         * * @var $provider \yii\data\ActiveDataProvider
         */
        ?>

        <div class="row">
            <div class="col-12">
                <h3>День недели</h3>
                <p><?php echo $model->title?></p>
                <h4>Предыдущая страница</h4>
                <p><?php echo \Yii::$app->session->get('page_url','no pages').PHP_EOL;?></p>

                <?php //\app\widgets\Activities\ActivityTableWidget::widget(['model' => $model]) ?>
                <?=\yii\grid\GridView::widget([
                    'dataProvider' => $provider,
                    'filterModel' => $model,
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
                        'email',
                        [
                            'attribute' => 'user.email',
                            'label' => 'Емаил пользователя'
                        ]
                    ]
                ])
                ?>

                <?= \yii\bootstrap\Html::a('Создать',['/activity/create'], ['class' => 'btn btn-success'])?>
            </div>
        </div>