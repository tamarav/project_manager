<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use app\models\Ucesnik;
use app\models\Zadatak;

/* @var $this yii\web\View */
/* @var $model app\models\RadiNaZadatku */

$uces=Ucesnik::findOne($model->ucesnik_id);

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Radi Na Zadatku', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="radi-na-zadatku-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Radi Na Zadatku'.' '. Html::encode($this->title) ?></h2>
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
        [
            'attribute' => 'zadatak.naziv',
            'label' => 'Zadatak',
        ],
        [
            'attribute' => 'ucesnik.id',
            'label' => 'Ucesnik',
        ],
        'postoji',
        ['attribute' => 'id', 'hidden' => true],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>