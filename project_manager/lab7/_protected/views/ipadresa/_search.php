<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\IpadresaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-ipadresa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

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
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
