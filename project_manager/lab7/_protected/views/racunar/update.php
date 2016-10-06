<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Racunar */

$this->title = 'Update Racunar: ' . ' ' . $model->naziv;
$this->params['breadcrumbs'][] = ['label' => 'Racunar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->naziv, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="racunar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
