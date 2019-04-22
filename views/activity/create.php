<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\models\Activity
 */
?>
<div class="row">
    <div class="col-12">
        <h3>Добавить событие</h3>
        <p><?php echo Yii::getAlias('@app')?></p>
        <h4>Предыдущая страница</h4>
        <p><?php echo \Yii::$app->session->get('page_url','no pages').PHP_EOL;?></p>
        <?php $form=\yii\bootstrap\ActiveForm::begin([

        ]);?>
        <?=$form->field($model,'title');?>
        <?=$form->field($model,'description')->textarea(['row'=>'3']);?>
        <?=$form->field($model,'startDate')->input('date');?>
        <?=$form->field($model,'isBlocking')->checkbox();?>
        <?=$form->field($model,'isRepeat')->checkbox();?>
        <?=$form->field($model,'repeatCount')->input('number',['value'=>'0']);?>
        <?=$form->field($model,'repeatInterval')->input('number',['value'=>'0']);?>
        <div class="form-group">
            <button class="btn btn-success" type="submit">Добавить</button>
        </div>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>
