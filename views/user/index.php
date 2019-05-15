<?php if ($this->beginCache('activities_list',['duration'=>10])):?>
    <?=\yii\widgets\DetailView::widget([
        'model' => $model,
        'attributes' => [
            'email:html',
        ],
    ])?>

    <?php $this->endCache();?>
<?php endif;?>

<?php $form=\yii\bootstrap\ActiveForm::begin(['options' => ['action'=>'/user/index']]);?>

<?=$form->field($model,'email',
    ['enableClientValidation'=>false,
        'enableAjaxValidation'=>true]
);?>

<div class="form-group">
    <button class="btn btn-success" type="submit">Сохранить</button>
</div>
<?php \yii\bootstrap\ActiveForm::end(); ?>
