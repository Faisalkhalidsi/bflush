<?php
/* @var $this yii\web\View */

use dosamigos\chartjs\ChartJs;
use kartik\daterange\DateRangePicker;
//use yii\bootstrap\Button;
use yii\bootstrap\Html;
//use yii\bootstrap\ActiveForm;

$this->registerJsFile("@web/js/osmQueue.js", [
    'depends' => [
        \yii\web\JqueryAsset::className()
    ]
]);
?>
<h1>Queue OSM Order</h1>
<!--<p>*Last 2 Hours</p>-->
<hr>

<div class="row">
    <div class="col-sm-3"></div>
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
    <div class="col-sm-3">
        <?php
        echo Html::submitButton('show', ['class' => 'btn btn-primary','id'=>'showBtn']);
//        ActiveForm::end();
        ?>
    </div>
</div>
<hr>



<?=
ChartJs::widget([
    'type' => 'line',
    'options' => [
        'height' => 3,
        'width' => 10
    ],
    'data' => [
        'labels' => $data,
        'datasets' => [
            [
                'label' => "Queue Total",
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