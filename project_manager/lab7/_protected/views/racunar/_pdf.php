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
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        'naziv',
        'opis:ntext',
        [
                'attribute' => 'prostorija.naziv',
                'label' => 'Prostorija'
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
            'heading' => Html::encode('Ipadresa'.' '. $this->title),
        ],
        'columns' => $gridColumnIpadresa
    ]);
?>
    </div>
</div>
