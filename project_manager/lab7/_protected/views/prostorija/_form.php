<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Prostorija */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'Racunar', 
        'relID' => 'racunar', 
        'value' => \yii\helpers\Json::encode($model->racunars),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="prostorija-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'broj')->textInput(['placeholder' => 'Broj']) ?>

    <?= $form->field($model, 'sprat')->textInput(['placeholder' => 'Sprat']) ?>

    <?= $form->field($model, 'zgrada')->textInput(['placeholder' => 'Zgrada']) ?>

    <?= $form->field($model, 'naziv')->textInput(['maxlength' => true, 'placeholder' => 'Naziv']) ?>

    <?= $form->field($model, 'opis')->textarea(['rows' => 6]) ?>

    <div class="form-group" id="add-racunar"></div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'),['index'],['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
