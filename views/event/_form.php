<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use kartik\date\DatePicker;
//use kartik\daterange\DateRangePicker;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">
    <?php $form = ActiveForm::begin(); ?>
    <hr>
    <div class="row">
        <div class="col-sm-10"></div>
        <div class="col-sm-1">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'category')->dropDownList(
            [
                'NOSSF-UIM' => 'NOSSF-UIM',
                'NOSSF-OSM' => 'NOSSF-OSM',
                'NOSSF-ASAP' => 'NOSSF-ASAP',
                'NOSSF-NOSSA' => 'NOSSF-NOSSA'
            ]
    );
    ?>
    <div class="row">
        <div class="col-sm-6">
            <?php
            echo '<label>Start Date</label>';
            echo DateTimePicker::widget([
                'name' => 'Event[created_date]',
//                'value' => date("Y-m-d H:i:s"),
                'options' => ['placeholder' => 'Select start time ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'y-MM-dd H:i:s',
                    'autoclose' => true,
                    'pickerPosition' => 'top-right',
//                    'startDate' => date("Y-m-d H:i:s"),
                    'todayHighlight' => true
                ]
            ]);
            ?>
        </div>
        <div class="col-sm-6">
            <?php
            echo '<label>Start Date</label>';
            echo DateTimePicker::widget([
                'name' => 'Event[end_date]',
//                'value' => date("Y-m-d H:i:s"),
                'options' => ['placeholder' => 'Select end time ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'y-MM-dd H:i:s',
                    'autoclose' => true,
                    'pickerPosition' => 'top-right',
//                    'startDate' => date("Y-m-d H:i:s"),
                    'todayHighlight' => true
                ]
            ]);
            ?>
        </div>
    </div>



    <!--<br>-->
    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <?php ActiveForm::end(); ?>

</div>
