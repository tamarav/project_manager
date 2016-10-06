<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProstorijaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-prostorija-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'broj')->textInput(['placeholder' => 'Broj']) ?>

    <?= $form->field($model, 'sprat')->textInput(['placeholder' => 'Sprat']) ?>

    <?= $form->field($model, 'zgrada')->textInput(['placeholder' => 'Zgrada']) ?>

    <?= $form->field($model, 'naziv')->textInput(['maxlength' => true, 'placeholder' => 'Naziv']) ?>

    <?php /* echo $form->field($model, 'opis')->textarea(['rows' => 6]) */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
