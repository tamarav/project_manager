<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Projekat */

$this->title = $model->naziv;
$this->params['breadcrumbs'][] = ['label' => 'Projekat', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projekat-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Projekat'.' '. Html::encode($this->title) ?></h2>
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
        //'postoji',
        [
                'attribute' => 'sef_na_projektu',
                'label' => 'Sef Na Projektu'
        ],
        [
                'attribute' => 'nadzor',
                'label' => 'Nadzor'
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
    $gridColumnRadiNaProjektu = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'ucesnik.id',
                'label' => 'Ucesnik'
        ],
        [
                'attribute' => 'projekat.naziv',
                'label' => 'Projekat'
        ],
        ['attribute' => 'id', 'hidden' => true],
        'postoji',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerRadiNaProjektu,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-radi-na-projektu']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Radi Na Projektu'.' '. $this->title),
        ],
        'columns' => $gridColumnRadiNaProjektu
    ]);
?>
    </div>
    
    <div class="row">
<?php
    $gridColumnZadatak = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'hidden' => true],
        [
                'attribute' => 'projekat.naziv',
                'label' => 'Projekat'
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
    echo Gridview::widget([
        'dataProvider' => $providerZadatak,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-zadatak']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Zadatak'.' '. $this->title),
        ],
        'columns' => $gridColumnZadatak
    ]);
?>
    </div>
</div>
