<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Prostorija */

$this->title = $model->naziv;
$this->params['breadcrumbs'][] = ['label' => 'Prostorija', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prostorija-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Prostorija'.' '. Html::encode($this->title) ?></h2>
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
        'broj',
        'sprat',
        'zgrada',
        'naziv',
        'opis:ntext',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerRacunar->totalCount){
    $gridColumnRacunar = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'hidden' => true],
            'naziv',
            'opis:ntext',
            [
                'attribute' => 'prostorija.naziv',
                'label' => 'Prostorija'
        ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerRacunar,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-lab7-racunar']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Racunar'.' '. $this->title),
        ],
        'columns' => $gridColumnRacunar
    ]);
}
?>
    </div>
</div>