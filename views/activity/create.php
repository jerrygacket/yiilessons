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
        <h3>Редактровать событие</h3>
        <?php
//            $arr=['onw'=>'tow','two'=>['tree'=>4]];
//
////            $val=ArrayHelper::getValue($arr,'osnw');
//            $val=ArrayHelper::getValue($arr,'two.tree');
//            print_r($val);
//
//            $db=[['id'=>5,'name'=>'Pavel','surname'=>'IVanov'],['id'=>2,'name'=>'Artem','surname'=>'Sidorov']];
//
//            $list=ArrayHelper::map($db,'id',function ($record){
//                return ArrayHelper::getValue($record,'name').' '.
//                    ArrayHelper::getValue($record,'surname');
//            });
//
//            print_r($list);

        ?>
        <h4>Предыдущая страница</h4>
        <p><?php echo \Yii::$app->session->get('page_url','no pages').PHP_EOL;?></p>

        <?php $form=\yii\bootstrap\ActiveForm::begin(['options' => ['action'=>'/activity/create','enctype' => 'multipart/form-data']]);?>

        <?=$form->field($model,'id')->hiddenInput()->label(false);?>

        <?=$form->field($model,'user_id')->hiddenInput()->label(false);?>

        <?=$form->field($model,'title',['enableClientValidation'=>false,
            'enableAjaxValidation'=>true]);?>
        <?=$form->field($model,'description')->textarea(['row'=>'3']);?>
        <?=$form->field($model,'dateStart')->textInput(['value' => \Yii::$app->formatter->asDate($model->dateStart ?? 'now', 'php:d.m.Y')]);?>
        <?=$form->field($model,'dateEnd')->textInput(['value' => \Yii::$app->formatter->asDate($model->dateEnd ?? 'now', 'php:d.m.Y')]);?>
        <?=$form->field($model,'useNotification')->checkbox();?>

        <?=$form->field($model,'email',
            ['enableClientValidation'=>false,
                'enableAjaxValidation'=>true]
        );?>
        <?=$form->field($model,'emailRepeat',
            ['enableClientValidation'=>false,
                'enableAjaxValidation'=>true]);?>

        <?=$form->field($model,'isBlocked')->checkbox();?>
        <?=$form->field($model,'isRepeat')->checkbox();?>
        <?=$form->field($model,'repeatCount',
            ['enableClientValidation'=>false,
                'enableAjaxValidation'=>true]
        )->dropDownList($model->getRepeatCountList())?>
        <?=$form->field($model,'repeatInterval',
            ['enableClientValidation'=>false,
            'enableAjaxValidation'=>true]
        )->input('number',['value'=>($model->repeatInterval ?? '0') ]);?>

        <?php // выводим уже существующие рисунки если есть
//        if (!empty($model->files)) {
//            echo '<h3>Существующие файлы</h3>';
//            foreach ($model->files as $file) {
//                echo \yii\helpers\Html::img('/images/'.$file,['width'=>200, 'alt'=>'no activity image']);
//            }
//        }
        ?>

        <?=$form->field($model,'uploadedFiles[]')->fileInput(['multiple'=>true])?>

        <div class="form-group">
            <button class="btn btn-success" type="submit">Сохранить</button>
        </div>
        <?php \yii\bootstrap\ActiveForm::end(); ?>

        <?= \yii\bootstrap\Html::a('Отмена',['/day'], ['class' => 'btn btn-danger'])?>
    </div>
</div>
