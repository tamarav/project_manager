<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Aktivnost */

$this->title = 'Update Aktivnost: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Aktivnost', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="aktivnost-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
