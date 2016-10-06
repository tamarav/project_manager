<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UcesnikSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-ucesnik-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'ime')->textInput(['maxlength' => true, 'placeholder' => 'Ime']) ?>

    <?= $form->field($model, 'prezime')->textInput(['maxlength' => true, 'placeholder' => 'Prezime']) ?>

    <?= $form->field($model, 'vrsta_ucesnika')->textInput(['maxlength' => true, 'placeholder' => 'Vrsta Ucesnika']) ?>

    <?= $form->field($model, 'postoji')->checkbox() ?>

    <?php /* echo $form->field($model, 'user_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose User'],
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
