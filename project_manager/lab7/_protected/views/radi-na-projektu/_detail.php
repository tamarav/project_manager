<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\RadiNaProjektu */

?>
<div class="radi-na-projektu-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        [
            'attribute' => 'ucesnik.id',
            'label' => 'Ucesnik',
        ],
        [
            'attribute' => 'projekat.naziv',
            'label' => 'Projekat',
        ],
        ['attribute' => 'id', 'hidden' => true],
        'postoji',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>