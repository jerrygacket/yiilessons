<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\models\Activity
 */
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-12">
        <h3>Добавить событие</h3>
        <p><?php echo Yii::getAlias('@app')?></p>

        <?php
            $arr=['onw'=>'tow','two'=>['tree'=>4]];

//            $val=ArrayHelper::getValue($arr,'osnw');
            $val=ArrayHelper::getValue($arr,'two.tree');
            print_r($val);

            $db=[['id'=>5,'name'=>'Pavel','surname'=>'IVanov'],['id'=>2,'name'=>'Artem','surname'=>'Sidorov']];

            $list=ArrayHelper::map($db,'id',function ($record){
                return ArrayHelper::getValue($record,'name').' '.
                    ArrayHelper::getValue($record,'surname');
            });

            print_r($list);

        ?>

        <h4>Предыдущая страница</h4>
        <p><?php echo \Yii::$app->session->get('page_url','no pages').PHP_EOL;?></p>
        <?php $form=\yii\bootstrap\ActiveForm::begin([
//            'enableClientValidation' => false
        ]);
        ?>

        <?=Html::input('text',Html::getInputName($model,'title'),123,['class'=>'sdf']);?>


        <?=$form->field($model,'title');?>
        <?=$form->field($model,'description')->textarea(['row'=>'3']);?>
        <?=$form->field($model,'startDate');?>
        <?=$form->field($model,'useNotification')->checkbox();?>
        <?=$form->field($model,'email',
            ['enableClientValidation'=>false,
                'enableAjaxValidation'=>true]
        );?>
        <?=$form->field($model,'emailRepeat');?>
        <?=$form->field($model,'isBlocking')->checkbox();?>
        <?=$form->field($model,'isRepeat')->checkbox();?>
        <?=$form->field($model,'repeatCount')
            ->dropDownList($model->getRepeatCountList())?>
        <?=$form->field($model,'repeatInterval')->input('number',['value'=>'0']);?>

        <?=$form->field($model,'file')->fileInput()?>

        <div class="form-group">
            <button class="btn btn-success" type="submit">Добавить</button>
        </div>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>
