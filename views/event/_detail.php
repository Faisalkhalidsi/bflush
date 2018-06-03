<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\grid\GridView;
use yii\bootstrap\Html;

$this->registerJsFile("@web/js/eventDetail.js", [
    'depends' => [
        \yii\web\JqueryAsset::className()
    ]
]);
?>
<?=

GridView::widget([
    'id' => 'detailList',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'Title',
            'format' => 'raw',
            'value' => function ($dataProvider) {
//                return Html::a($dataProvider->title, ['/event/view', 'id' => $dataProvider->id], ['target' => '_blank']);
                return Html::a($dataProvider->title, ['/event/view2', 'id' => $dataProvider->id], ['target' => '_blank', 'data-pjax' => "0"]);
            },
        ],
//        'title',
        'category',
//        'description',
        'created_date',
//        'end_date',
//        ['class' => 'yii\grid\ActionColumn',
//            'template' => '{view}',
//            'headerOptions' => ['class' => 'activity-view-link',],
//            'contentOptions' => ['class' => 'padding-left-5px'],
//            'buttons' => [
//                'view' => function ($url, $model, $key) {
//                    return Html::a('<span class="glyphicon glyphicon-search"></span>', '#', [
//                                'class' => 'activity-view-link',
//                                'data-pjax' => "0",
//                    ]);
//                },
//            ],
//        ],
    ],
]);
?>