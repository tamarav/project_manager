<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Projekat */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'RadiNaProjektu', 
        'relID' => 'radi-na-projektu', 
        'value' => \yii\helpers\Json::encode($model->radiNaProjektus),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'Zadatak', 
        'relID' => 'zadatak', 
        'value' => \yii\helpers\Json::encode($model->zadataks),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="projekat-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'naziv')->textInput(['maxlength' => true, 'placeholder' => 'Naziv']) ?>

    <?= $form->field($model, 'datum_pocetka_rada')->widget(\kartik\widgets\DatePicker::classname(), [
        'options' => ['placeholder' => 'Choose Datum Pocetka Rada'],
        'type' => \kartik\widgets\DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-m-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'datum_kraja_rada')->widget(\kartik\widgets\DatePicker::classname(), [
        'options' => ['placeholder' => 'Choose Datum Kraja Rada'],
        'type' => \kartik\widgets\DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-m-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'budzet')->textInput(['maxlength' => true, 'placeholder' => 'Budzet']) ?>

    <?= $form->field($model, 'opis_projekta')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'aktivan')->checkbox() ?>

    <?= $form->field($model, 'krajnji_rok')->widget(\kartik\widgets\DatePicker::classname(), [
        'options' => ['placeholder' => 'Choose Krajnji Rok'],
        'type' => \kartik\widgets\DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-m-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'uradjeno')->textInput(['placeholder' => 'Uradjeno']) ?>

    <?= $form->field($model, 'postoji')->checkbox() ?>

    <?= $form->field($model, 'sef_na_projektu')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Ucesnik::find()->orderBy('id')->asArray()->all(), 'id', 'ime'),
        'options' => ['placeholder' => 'Choose Ucesnik'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'nadzor')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Ucesnik::find()->orderBy('id')->asArray()->all(), 'id', 'ime'),
        'options' => ['placeholder' => 'Choose Ucesnik'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <div class="form-group" id="add-radi-na-projektu"></div>

    <div class="form-group" id="add-zadatak"></div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'),['index'],['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
