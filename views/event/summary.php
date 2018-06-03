<?php
use dosamigos\chartjs\ChartJs;

$this->title = 'NOSS Activities Summaries';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3>NOSS Activities Summary</h3>

<hr>
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
            <?=
            $this->render('_sumOsm', [
                'dataProviderOSM' => $dataProviderOSM,
            ])
            ?>
        </div>
        <div class="col-lg-4">
            <?=
            $this->render('_sumUIM', [
                'dataProviderUIM' => $dataProviderUIM,
            ])
            ?>
        </div>
        <div class="col-lg-4">
            <?=
            $this->render('_sumNOSSA', [
                'dataProviderNOSSA' => $dataProviderNOSSA,
            ])
            ?>
        </div>
    </div>
</div> 