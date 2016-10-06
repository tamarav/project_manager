<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Ipadresa */

$this->title = $model->dd;
$this->params['breadcrumbs'][] = ['label' => 'Ipadresa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ipadresa-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Ipadresa'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        'dd',
        'fqdn',
        'kartica',
        [
                'attribute' => 'racunar.naziv',
                'label' => 'Racunar'
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
