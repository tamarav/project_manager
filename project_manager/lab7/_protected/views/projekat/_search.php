<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjekatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-projekat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'naziv')->textInput(['maxlength' => true, 'placeholder' => 'Naziv']) ?>

    <?= $form->field($model, 'datum_pocetka_rada')->widget(\kartik\widgets\DatePicker::classname(), [
        'options' => ['placeholder' => 'Choose Datum Pocetka Rada'],
        'type' => \kartik\widgets\DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-M-yyyy'
        ]
    ]); ?>

    <?= $form->field($model, 'datum_kraja_rada')->widget(\kartik\widgets\DatePicker::classname(), [
        'options' => ['placeholder' => 'Choose Datum Kraja Rada'],
        'type' => \kartik\widgets\DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-M-yyyy'
        ]
    ]); ?>

    <?= $form->field($model, 'budzet')->textInput(['maxlength' => true, 'placeholder' => 'Budzet']) ?>

    <?php /* echo $form->field($model, 'opis_projekta')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field($model, 'aktivan')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'krajnji_rok')->widget(\kartik\widgets\DatePicker::classname(), [
        'options' => ['placeholder' => 'Choose Krajnji Rok'],
        'type' => \kartik\widgets\DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-M-yyyy'
        ]
    ]); */ ?>

    <?php /* echo $form->field($model, 'uradjeno')->textInput(['placeholder' => 'Uradjeno']) */ ?>

    <?php /* echo $form->field($model, 'postoji')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'sef_na_projektu')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Ucesnik::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose Ucesnik'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) */ ?>

    <?php /* echo $form->field($model, 'nadzor')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Ucesnik::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose Ucesnik'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
