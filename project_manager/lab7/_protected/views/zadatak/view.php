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
    
    <div class="row">
<?php
if($providerAktivnost->totalCount){
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
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Aktivnost'.' '. $this->title),
        ],
        'columns' => $gridColumnAktivnost
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerRadiNaZadatku->totalCount){
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
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Radi Na Zadatku'.' '. $this->title),
        ],
        'columns' => $gridColumnRadiNaZadatku
    ]);
}
?>
    </div>
</div>