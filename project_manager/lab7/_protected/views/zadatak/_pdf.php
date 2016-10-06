<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Zadatak */

$this->title = $model->naziv;
$this->params['breadcrumbs'][] = ['label' => 'Zadatak', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zadatak-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Zadatak'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
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
       // 'aktivan',
        'procenat_dovrsenosti',
      //  'postoji',
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
