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

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?php
    echo '<label>Start Date/Time</label>';
    echo DateTimePicker::widget([
        'name' => 'Event[created_date]',
        'value' => date("Y-m-d H:i:s"),
        'options' => ['placeholder' => 'Select start time ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'y-MM-dd H:i:s',
            'autoclose' => true,
            'pickerPosition' => 'top-right',
//            'startDate' => date("Y-m-d H:i:s"),
            'todayHighlight' => true
        ]
    ]);
    ?>
    <br>
    <?php
    echo '<label>Start Date/Time</label>';
    echo DateTimePicker::widget([
        'name' => 'Event[end_date]',
        'value' => date("Y-m-d H:i:s"),
        'options' => ['placeholder' => 'Select end time ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'y-MM-dd H:i:s',
            'autoclose' => true,
            'pickerPosition' => 'top-right',
//            'startDate' => date("Y-m-d H:i:s"),
            'todayHighlight' => true
        ]
    ]);
    ?>




    <?php
//    echo '<label>Start Date</label> <br>';
//    echo DateRangePicker::widget([
//        'name' => 'Event[created_date]',
//        'value' => date("Y-m-d H:i:s"),
//        'options' => ['placeholder' => 'Select end date ...'],
//        'pluginOptions' => [
//            'locale' => ['format' => 'Y-m-d H:i:s'],
//            'autoclose' => true,
//            'todayHighlight' => true,
//            'singleDatePicker' => true
//        ]
//    ]);
    ?>  
    <br><br>
    <?php
//    echo '<label>End Date</label> <br>';
//    echo DateRangePicker::widget([
//        'name' => 'Event[end_date]',
//        'value' => date("Y-m-d H:i:s"),
//        'options' => ['placeholder' => 'Select end date ...'],
//        'pluginOptions' => [
//            'locale' => ['format' => 'Y-m-d H:i:s'],
//            'autoclose' => true,
//            'todayHighlight' => true,
//            'singleDatePicker' => true
//        ]
//    ]);
    ?>
    <br>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
