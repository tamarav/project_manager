<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
$items = [
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Ucesnik'),
        'content' => $this->render('_detail', [
            'model' => $model,
        ]),
    ],
        [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Aktivnost'),
        'content' => $this->render('_dataAktivnost', [
            'model' => $model,
            'row' => $model->aktivnosts,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Projekat'),
        'content' => $this->render('_dataProjekat', [
            'model' => $model,
            'row' => $model->projekats,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Radi Na Projektu'),
        'content' => $this->render('_dataRadiNaProjektu', [
            'model' => $model,
            'row' => $model->radiNaProjektus,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Radi Na Zadatku'),
        'content' => $this->render('_dataRadiNaZadatku', [
            'model' => $model,
            'row' => $model->radiNaZadatkus,
        ]),
    ],
        ];
echo TabsX::widget([
    'items' => $items,
    'position' => TabsX::POS_ABOVE,
    'encodeLabels' => false,
    'class' => 'tes',
    'pluginOptions' => [
        'bordered' => true,
        'sideways' => true,
        'enableCache' => false
        //        'height' => TabsX::SIZE_TINY
    ],
    'pluginEvents' => [
        "tabsX.click" => "function(e) {setTimeout(function(e){
                if ($('.nav-tabs > .active').next('li').length == 0) {
                    $('#prev').show();
                    $('#next').hide();
                } else if($('.nav-tabs > .active').prev('li').length == 0){
                    $('#next').show();
                    $('#prev').hide();
                }else{
                    $('#next').show();
                    $('#prev').show();
                };
                console.log(JSON.stringify($('.active', '.nav-tabs').html()));
            },10)}",
    ],
]);
?>
