<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Zadatak */

?>
<div class="zadatak-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->naziv) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        [
            'attribute' => 'projekat.naziv',
            'label' => 'Projekat',
        ],
        'naziv',
        'pocetak_rada',
        'kraj_rada',
        'rok_za_zavrsetak',
        'radnih_sati_potrebno',
        'opis:ntext',
        'aktivan',
        'procenat_dovrsenosti',
        'postoji',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>