<?php

use dosamigos\chartjs\ChartJs;
use yii\grid\GridView;
use yii\bootstrap\Html;

$this->title = 'NOSS Activities Summaries';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3>NOSS Activities Summary</h3>
<hr>
<p>*Today</p>
<div class="container">
    <div class="row">
        <div id="chart" class="center-block">
            <?=
            ChartJs::widget([
                'type' => 'pie',
                'id' => 'structurePie',
                'options' => [
                    'height' => 200,
                    'width' => 400,
                ],
                'clientOptions' => [
                    'legend' => [
                        'display' => TRUE,
                        'position' => 'bottom',
                        'labels' => [
                            'fontSize' => 14,
                            'fontColor' => "#425062",
                        ]
                    ],
                    'tooltips' => [
                        'enabled' => true,
                        'intersect' => true
                    ],
                    'hover' => [
                        'mode' => false
                    ],
                    'maintainAspectRatio' => false,
                ],
                'data' => [
                    'radius' => "90%",
                    'labels' => $data['label'], // Your labels
                    'datasets' => [
                        [
                            'data' => $data['pct'], // Your dataset
                            'label' => '',
                            'backgroundColor' => [
                                '#ADC3FF',
                                '#FF9A9A',
                                'rgba(190, 124, 145, 0.8)',
                                'rgba(0, 124, 145, 0.8)'
                            ],
                            'borderColor' => [
                                '#fff',
                                '#fff',
                                '#fff',
                                '#fff'
                            ],
                            'borderWidth' => 1,
                            'hoverBorderColor' => ["#999", "#999", "#999"],
                        ]
                    ]
                ],
            ]);
            ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-4 ">
            <h4>NOSSF-OSM Activities</h4>
            <hr>
            <?=
            GridView::widget([
                'id' => 'detailList',
                'dataProvider' => $dataProviderOSM,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'label' => 'Title',
                        'format' => 'raw',
                        'value' => function ($dataProviderOSM) {
                            return Html::a($dataProviderOSM->title, ['/event/view2', 'id' => $dataProviderOSM->id], ['target' => '_blank', 'data-pjax' => "0"]);
                        },
                    ],
                    'created_date',
                ],
            ]);
            ?>
        </div>
        <div class="col-lg-4">
            <h4>NOSSF-UIM Activities</h4>
            <hr>
            <?=
            GridView::widget([
                'id' => 'detailList',
                'dataProvider' => $dataProviderUIM,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'label' => 'Title',
                        'format' => 'raw',
                        'value' => function ($dataProviderUIM) {
                            return Html::a($dataProviderUIM->title, ['/event/view2', 'id' => $dataProviderUIM->id], ['target' => '_blank', 'data-pjax' => "0"]);
                        },
                    ],
                    'created_date',
                ],
            ]);
            ?>
        </div>
        <div class="col-lg-4">
            <h4>NOSSA Activities</h4>
            <hr>
            <?=
            GridView::widget([
                'id' => 'detailList',
                'dataProvider' => $dataProviderNOSSA,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'label' => 'Title',
                        'format' => 'raw',
                        'value' => function ($dataProviderNOSSA) {
                            return Html::a($dataProviderNOSSA->title, ['/event/view2', 'id' => $dataProviderNOSSA->id], ['target' => '_blank', 'data-pjax' => "0"]);
                        },
                    ],
                    'created_date',
                ],
            ]);
            ?>
        </div>
    </div>
</div> 