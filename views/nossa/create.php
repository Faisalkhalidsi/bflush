<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\NossaStatusIntegrasi */

$this->title = 'Create Nossa Status Integrasi';
$this->params['breadcrumbs'][] = ['label' => 'Nossa Status Integrasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nossa-status-integrasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
