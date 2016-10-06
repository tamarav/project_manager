<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Racunar */

$this->title = 'Create Racunar';
$this->params['breadcrumbs'][] = ['label' => 'Racunar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="racunar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
