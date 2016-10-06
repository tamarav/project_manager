<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->projekats,
        'key' => 'id'
    ]);
    $gridColumns = [
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
                'attribute' => 'nadzor',
                'label' => 'Nadzor'
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'projekat'
        ],
    ];
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'containerOptions' => ['style' => 'overflow: auto'],
        'pjax' => true,
        'beforeHeader' => [
            [
                'options' => ['class' => 'skip-export']
            ]
        ],
        'export' => [
            'fontAwesome' => true
        ],
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => false,
        'persistResize' => false,
    ]);
