<?php
/**
 * @var $authModel \app\models\Users
 * @var $activityProvider \yii\data\ActiveDataProvider
 * @var $activityModel \app\models\Activity
 */
?>
<h1>Панель администратора</h1>
<hr>
<h2>Новый пользователь</h2>
<div class="row">
    <div class="col-md-6">
        <?php $form=\yii\bootstrap\ActiveForm::begin([
            'method' => 'POST'
        ]); ?>
        <?=$form->field($authModel,'email');?>
        <?=$form->field($authModel,'password')->passwordInput()?>

        <div class="form-group">
            <button type="submit">Регистрация</button>
        </div>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>

<hr>
<h2>Все активности</h2>
<?=\yii\grid\GridView::widget([
    'dataProvider' => $activityProvider,
    'filterModel' => $activityModel,
    'tableOptions' => [
        'class' => 'table table-bordered table-hover'
    ],
    'rowOptions' => function($activityModel,$key,$index,$grid) {
        $class = $index%2?'odd':'even';
        return ['class'=>$class,'key'=>$key,'index'=>$index];
    },
    'layout' => "{summary}\n{pager}\n{items}\n{pager}",
    'columns' => [
        ['class'=>\yii\grid\SerialColumn::class,],
        [
            'attribute' => 'title',
            'value' => function($activityModel) {
                return \yii\bootstrap\Html::a(\yii\bootstrap\Html::encode($activityModel->title), ['/activity','activityId'=>$activityModel->id]);
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