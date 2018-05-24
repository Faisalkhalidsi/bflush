<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nossa Status Integrasis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nossa-status-integrasi-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?php Pjax::begin(); ?>

    <p>
<?= Html::a('Create Nossa Status Integrasi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'integration_type',
            'queue',
            'waktu',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
<?php Pjax::end(); ?>
</div>
