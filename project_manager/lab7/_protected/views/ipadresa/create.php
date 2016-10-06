<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ipadresa */

$this->title = 'Create Ipadresa';
$this->params['breadcrumbs'][] = ['label' => 'Ipadresa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ipadresa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
