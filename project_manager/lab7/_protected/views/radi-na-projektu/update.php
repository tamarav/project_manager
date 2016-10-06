<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RadiNaProjektu */

$this->title = 'Update Radi Na Projektu: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Radi Na Projektu', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="radi-na-projektu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
