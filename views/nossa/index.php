<?php

use yii\helpers\Html;
use yii\grid\GridView;
//use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
//$this->registerJsFile("@web/js/nossaIntegration.js", [
//    'depends' => [
//        \yii\web\JqueryAsset::className()
//    ]
//]);

$this->title = 'Nossa Status Integrasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nossa-status-integrasi-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <hr>
    <div class="row">
        <?php $form = ActiveForm::begin(); ?>
        <div class="col-sm-4"></div>
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
                'id' => 'timeParam',
                'name' => 'date_range',
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
            echo Html::submitButton('show', ['class' => 'btn btn-primary', 'id' => 'showBtn']);
//        ActiveForm::end();
            ?>
        </div>
    </div>
    <hr>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            'integration_type',
            'queue',
            'waktu',
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>


    

    <?php ActiveForm::end(); ?>

</div>
