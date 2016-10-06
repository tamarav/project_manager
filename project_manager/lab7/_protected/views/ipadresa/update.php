<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ipadresa */

$this->title = 'Update Ipadresa: ' . ' ' . $model->dd;
$this->params['breadcrumbs'][] = ['label' => 'Ipadresa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dd, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ipadresa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
