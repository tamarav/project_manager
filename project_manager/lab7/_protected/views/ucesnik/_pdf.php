<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Ucesnik */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ucesnik', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ucesnik-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Ucesnik'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        'ime',
        'prezime',
        'vrsta_ucesnika',
       // 'postoji',
        [
                'attribute' => 'user.id',
                'label' => 'User'
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
    $gridColumnAktivnost = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'hidden' => true],
        [
                'attribute' => 'ucesnik.id',
                'label' => 'Ucesnik'
        ],
        [
                'attribute' => 'zadatak.naziv',
                'label' => 'Zadatak'
        ],
        'opis:ntext',
        'potroseno_vremena',
        'datum',
        'postoji',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerAktivnost,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-aktivnost']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Aktivnost'.' '. $this->title),
        ],
        'columns' => $gridColumnAktivnost
    ]);
?>
    </div>
    
    <div class="row">
<?php
    $gridColumnProjekat = [
        ['class' => 'yii\grid\SerialColumn'],
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
                'label' => 'Sef Na Projektu'
        ],
        [
                'attribute' => 'nadzor',
                'label' => 'Nadzor'
        ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerProjekat,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-projekat']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Projekat'.' '. $this->title),
        ],
        'columns' => $gridColumnProjekat
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
    $gridColumnRadiNaZadatku = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'zadatak.naziv',
                'label' => 'Zadatak'
        ],
        [
                'attribute' => 'ucesnik.id',
                'label' => 'Ucesnik'
        ],
        'postoji',
        ['attribute' => 'id', 'hidden' => true],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerRadiNaZadatku,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-radi-na-zadatku']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Radi Na Zadatku'.' '. $this->title),
        ],
        'columns' => $gridColumnRadiNaZadatku
    ]);
?>
    </div>
</div>
