<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Racunar */

?>
<div class="racunar-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->naziv) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        'naziv',
        'opis:ntext',
        [
            'attribute' => 'prostorija.naziv',
            'label' => 'Prostorija',
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>