<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Aktivnost */

?>
<div class="aktivnost-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        [
            'attribute' => 'ucesnik.ime',
            'label' => 'Ucesnik',
        ],
        [
            'attribute' => 'zadatak.naziv',
            'label' => 'Zadatak',
        ],
        'opis:ntext',
        'potroseno_vremena',
        'datum',
        'postoji',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>