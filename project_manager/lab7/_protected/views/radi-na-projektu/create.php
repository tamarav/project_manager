<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RadiNaProjektu */

$this->title = 'Create Radi Na Projektu';
$this->params['breadcrumbs'][] = ['label' => 'Radi Na Projektu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="radi-na-projektu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
