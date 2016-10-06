<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Projekat */

?>
<div class="projekat-view">

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
        'datum_pocetka_rada',
        'datum_kraja_rada',
        'budzet',
        'opis_projekta:ntext',
        'aktivan',
        'krajnji_rok',
        'uradjeno',
        'postoji',
        [
            'attribute' => 'sef_na_projektu',
            'label' => 'Sef Na Projektu',
        ],
        [
            'attribute' => 'nadzor',
            'label' => 'Nadzor',
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>