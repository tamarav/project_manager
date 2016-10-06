<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Rashod */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rashod', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rashod-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Rashod'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        [
                'attribute' => 'aktivnost.id',
                'label' => 'Aktivnost'
        ],
        'opis:ntext',
        'datum',
        'novcani_iznos',
       // 'postoji',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
