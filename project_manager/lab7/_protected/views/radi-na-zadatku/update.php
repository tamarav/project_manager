<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RadiNaZadatku */

$this->title = 'Update Radi Na Zadatku: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Radi Na Zadatku', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="radi-na-zadatku-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
