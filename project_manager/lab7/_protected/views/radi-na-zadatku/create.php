<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RadiNaZadatku */

$this->title = 'Create Radi Na Zadatku';
$this->params['breadcrumbs'][] = ['label' => 'Radi Na Zadatku', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="radi-na-zadatku-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
