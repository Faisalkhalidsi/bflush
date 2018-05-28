<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use dosamigos\chartjs\ChartJs;
use yii\bootstrap\Html;

$this->title = 'NOSSA DB Status';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nossa-status-integrasi-index">
    <hr>
    <div class = "row">
        <div class = "col-sm-5">
            <div id="chart" class="center-block">
                <center><h4>Work Order Total </h4></center>
                <?=
                ChartJs::widget([
                    'id' => 'nossaWorkOrderCrx',
                    'type' => 'line',
                    'options' => [
                        'height' => 3,
                        'width' => 10,
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
        <div class = "col-sm-5">
            <div id="chart" class="center-block">
                <center><h4>Session DB Total </h4></center>
                <?=
                ChartJs::widget([
                    'id' => 'nossaSessionDBCrx',
                    'type' => 'line',
                    'options' => [
                        'height' => 3,
                        'width' => 10,
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
                        'labels' => $dataSessionDB,
                        'datasets' => [
                            [
                                'label' => "Work Order Total",
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