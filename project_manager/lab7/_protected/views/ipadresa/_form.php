<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ipadresa */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="ipadresa-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'dd')->textInput(['maxlength' => true, 'placeholder' => 'Dd']) ?>

    <?= $form->field($model, 'fqdn')->textInput(['maxlength' => true, 'placeholder' => 'Fqdn']) ?>

    <?= $form->field($model, 'kartica')->textInput(['maxlength' => true, 'placeholder' => 'Kartica']) ?>

    <?= $form->field($model, 'racunar_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Racunar::find()->orderBy('id')->asArray()->all(), 'id', 'naziv'),
        'options' => ['placeholder' => 'Choose Lab7 racunar'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'),['index'],['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
