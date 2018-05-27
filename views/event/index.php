<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerJsFile("@web/js/event.js", [
    'depends' => [
        \yii\web\JqueryAsset::className()
    ]
]);

$this->title = 'NOSS Activities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
    <?php
    Modal::begin([
        'header' => '<h4>Event</h4>',
        'id' => 'model',
        'size' => 'model-lg',
    ]);

    echo "<div id='modelContent'></div>";

    Modal::end();
    ?>

    <?=
    yii2fullcalendar\yii2fullcalendar::widget([
        'events' => $events,
//        'options' => [
////            'lang' => 'de',
//        //... more options to be defined here!
//        ],
//        'events' => Url::to(['/timetrack/default/jsoncalendar'])
    ]);
    ?>



    <?php Pjax::end(); ?>
</div>
