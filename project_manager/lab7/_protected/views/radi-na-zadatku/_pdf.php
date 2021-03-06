<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\RadiNaZadatku */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Radi Na Zadatku', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="radi-na-zadatku-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Radi Na Zadatku'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        [
                'attribute' => 'zadatak.naziv',
                'label' => 'Zadatak'
        ],
        [
                'attribute' => 'ucesnik.id',
                'label' => 'Ucesnik'
        ],
        //'postoji',
        ['attribute' => 'id', 'hidden' => true],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
