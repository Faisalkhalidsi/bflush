<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NossaStatusIntegrasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nossa-status-integrasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'integration_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'queue')->textInput() ?>

    <?= $form->field($model, 'waktu')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
