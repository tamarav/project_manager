<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Racunar */

$this->title = $model->naziv;
$this->params['breadcrumbs'][] = ['label' => 'Racunar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="racunar-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Racunar'.' '. Html::encode($this->title) ?></h2>
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
        'opis:ntext',
        [
            'attribute' => 'prostorija.naziv',
            'label' => 'Prostorija',
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
if($providerIpadresa->totalCount){
    $gridColumnIpadresa = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'hidden' => true],
            'dd',
            'fqdn',
            'kartica',
            [
                'attribute' => 'racunar.naziv',
                'label' => 'Racunar'
        ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerIpadresa,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-lab7-ipadresa']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Ipadresa'.' '. $this->title),
        ],
        'columns' => $gridColumnIpadresa
    ]);
}
?>
    </div>
</div>