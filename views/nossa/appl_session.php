<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use dosamigos\chartjs\ChartJs;
//use yii\bootstrap\Html;
use kartik\select2\Select2;
use yii\bootstrap\Button;
use kartik\daterange\DateRangePicker;

$this->registerJsFile("@web/js/applSession.js", [
    'depends' => [
        \yii\web\JqueryAsset::className()
    ]
]);

$this->title = 'NOSSA Application Session';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nossa-status-integrasi-index">
    <hr>
    <div class="row">

        <?php
// Without model and implementing a multiple select
        echo "<div class='col-sm-2'>";
        echo '<label class="control-label">Server Name</label>';
        echo "</div>";
        echo "<div class='col-sm-7'>";
        echo Select2::widget([
            'name' => 'state_10',
            'data' => $label,
            'options' => [
                'placeholder' => 'Select Server Name ...',
                'name' => 'serverList',
                'multiple' => true
            ],
        ]);
        echo "</div>";
        ?>


    </div>
    <br>
    <div class="row">
        <div class='col-sm-2'>
            <label class="control-label">Range</label>
        </div>
        <div class="col-sm-3">
            <?php
            date_default_timezone_set('Asia/Jakarta');
//        $form = ActiveForm::begin(['id' => 'osmQueue-form']);
            $addon = <<< HTML
<span class="input-group-addon">
    <i class="glyphicon glyphicon-calendar"></i>
</span>
HTML;
            echo '<div class="input-group drp-container">';
            echo DateRangePicker::widget([
                'id' => 'startParam',
                'name' => 'date_range_1',
                'value' => date("Y-m-d H:i"),
                'useWithAddon' => true,
                'convertFormat' => true,
                'pluginOptions' => [
                    'timePicker' => true,
                    'timePickerIncrement' => 5,
                    'locale' => ['format' => 'Y-m-d H:i'],
                    'singleDatePicker' => true,
                    'showDropdowns' => true
                ]
            ]) . $addon;
            echo '</div>';
            ?>
        </div>
        <div class="col-sm-3">
            <?php
            echo '<div class="input-group drp-container">';
            echo DateRangePicker::widget([
                'id' => 'endParam',
                'name' => 'date_range_2',
                'value' => date("Y-m-d H:i"),
                'useWithAddon' => true,
                'convertFormat' => true,
                'pluginOptions' => [
                    'timePicker' => true,
                    'timePickerIncrement' => 5,
                    'locale' => ['format' => 'Y-m-d H:i'],
                    'singleDatePicker' => true,
                    'showDropdowns' => true
                ]
            ]) . $addon;
            echo '</div>';
            ?>
        </div>
        <div class='col-sm-3'>
            <?=
            Button::widget([
                'id' => 'showBtn',
                'label' => 'Show',
                'options' => ['class' => 'btn-success'],
            ]);
            ?>

        </div>
    </div>
    <hr>
    <div class="row">
        <div id="chart" class="center-block">
            <center><h4>Appl Session Total</h4></center>
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
                    'labels' => [],
                    'datasets' => []
                ]
            ]);
            ?>
        </div>
    </div>

    <hr>

    <hr>
</div>