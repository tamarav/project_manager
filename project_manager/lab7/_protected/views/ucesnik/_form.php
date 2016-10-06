<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ucesnik */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'Aktivnost', 
        'relID' => 'aktivnost', 
        'value' => \yii\helpers\Json::encode($model->aktivnosts),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'Projekat', 
        'relID' => 'projekat', 
        'value' => \yii\helpers\Json::encode($model->projekats),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
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
        'class' => 'RadiNaZadatku', 
        'relID' => 'radi-na-zadatku', 
        'value' => \yii\helpers\Json::encode($model->radiNaZadatkus),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="ucesnik-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'ime')->textInput(['maxlength' => true, 'placeholder' => 'Ime']) ?>

    <?= $form->field($model, 'prezime')->textInput(['maxlength' => true, 'placeholder' => 'Prezime']) ?>

   <!-- <?= $form->field($model, 'vrsta_ucesnika')->textInput(['maxlength' => true, 'placeholder' => 'Vrsta Ucesnika']) ?> -->

    <?= $form->field($model, 'postoji')->checkbox() ?>

    <?= $form->field($model, 'user_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\User::find()->where(['status' => 1])->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => 'Choose User'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <div class="form-group" id="add-aktivnost"></div>

    <div class="form-group" id="add-projekat"></div>

    <div class="form-group" id="add-radi-na-projektu"></div>

    <div class="form-group" id="add-radi-na-zadatku"></div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'),['index'],['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
