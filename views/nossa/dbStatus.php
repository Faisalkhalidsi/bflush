<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use dosamigos\chartjs\ChartJs;
use yii\bootstrap\Html;
use yii\grid\GridView;

$this->title = 'NOSSA DB Status';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nossa-status-integrasi-index">
    <hr>
    <center><h4><?= Html::a("DB Uptime", ['nossa/appl_session'], ['target' => '_blank']) ?></h4></center>
    <div class="row">
        <?=
        GridView::widget([
            'showFooter' => false,
            'showHeader' => true,
            'dataProvider' => $dataProvider,
            'columns' => [
                'instance_name',
                'hostname',
                'uptime',
                'status',
            ],
        ]);
        ?>
    </div>
    <hr>
    <div class="row">
        <div id="chart" class="center-block">
            <center><h4><?= Html::a("Appl Session Total", ['nossa/appl_session'], ['target' => '_blank']) ?></h4></center>
            <?=
            ChartJs::widget([
                'id' => 'nossaSessionApplCrx',
                'type' => 'line',
                'options' => [
                    'height' => 3,
                    'width' => 15,
                ],
                'clientOptions' => [
                    'legend' => [
                        'display' => false,
                        'position' => 'left',
                        'labels' => [
                            'fontColor' => "#425062",
                        ]
                    ],
                    'tooltips' => [
                        'enabled' => true,
                        'intersect' => true
                    ],
                    'hover' => [
                        'mode' => true
                    ],
                    'maintainAspectRatio' => true,
                ],
                'data' => [
                    'labels' => $dataPackets,
                    'datasets' => $packets
                ]
            ]);
            ?>
        </div>
    </div>
    <hr>
    <div class = "row">
        <div class = "col-sm-6">
            <div id="chart" class="center-block">
                <center><h4><?= Html::a("Work Order Total", ['nossa/index'], ['target' => '_blank']) ?></h4></center>
                <?=
                ChartJs::widget([
                    'id' => 'nossaWorkOrderCrx',
                    'type' => 'line',
//                    'options' => [
//                        'height' => 3,
//                        'width' => 15,
//                    ],
                    'clientOptions' => [
                        'legend' => [
                            'display' => false,
                            'position' => 'left',
                            'labels' => [
                                'fontColor' => "#425062",
                            ]
                        ],
                        'tooltips' => [
                            'enabled' => true,
                            'intersect' => true
                        ],
                        'hover' => [
                            'mode' => true
                        ],
                        'maintainAspectRatio' => true,
                    ],
                    'data' => [
                        'labels' => $data,
                        'datasets' => [
                            [
                                'label' => "Work Order Total",
                                'backgroundColor' => "rgba(0,0,255,0)",
                                'borderColor' => "rgba(0,0,255,0.5)",
                                'pointBackgroundColor' => "rgba(255,99,132,1)",
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                                'data' => $dataOwn
                            ]
                        ]
                    ]
                ]);
                ?>
            </div>
        </div>
        <div class = "col-sm-6">
            <div id="chart" class="center-block">
                <center><h4><?= Html::a("Session DB Total", ['nossa/index'], ['target' => '_blank']) ?></h4></center>
                <?=
                ChartJs::widget([
                    'id' => 'nossaSessionDBCrx',
                    'type' => 'line',
                    'clientOptions' => [
                        'legend' => [
                            'display' => false,
                            'position' => 'left',
                            'labels' => [
                                'fontColor' => "#425062",
                            ]
                        ],
                        'tooltips' => [
                            'enabled' => true,
                            'intersect' => true
                        ],
                        'hover' => [
                            'mode' => true
                        ],
                        'maintainAspectRatio' => true,
                    ],
                    'data' => [
                        'labels' => $dataSessionDB,
                        'datasets' => [
                            [
                                'label' => "Session DB Total",
                                'backgroundColor' => "rgba(0,0,255,0)",
                                'borderColor' => "rgba(0,0,255,0.5)",
                                'pointBackgroundColor' => "rgba(255,99,132,1)",
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                                'data' => $dataOwnSessionDB
                            ]
                        ]
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
    <hr>
</div>