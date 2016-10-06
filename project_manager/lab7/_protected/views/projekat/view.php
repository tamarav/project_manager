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
        <div class="col-sm-3" style="margin-top: 15px">
            <?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', 
                ['pdf', 'id' => $model['id']],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]
            )?>                        
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
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
    
    <div class="row">
<?php
if($providerRadiNaProjektu->totalCount){
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
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Radi Na Projektu'.' '. $this->title),
        ],
        'columns' => $gridColumnRadiNaProjektu
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerZadatak->totalCount){
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
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Zadatak'.' '. $this->title),
        ],
        'columns' => $gridColumnZadatak
    ]);
}
?>
    </div>
</div>