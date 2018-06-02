<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;

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
    <?php
    Modal::begin([
        'id' => 'model',
        'size' => 'model-lg',
//        'footer' => '<a href="#" class="btn btn-success" data-dismiss="modal">Close</a>',
    ]);

    echo "<div id='modelContent'></div>";

    Modal::end();
    ?>
    <p>

        <?php
        echo Button::widget([
            'label' => 'Create Event',
            'id' => 'createBtn',
            'options' => ['class' => 'btn btn-success'],
        ]);
        ?>
    </p>
    <?=
    yii2fullcalendar\yii2fullcalendar::widget([
        'events' => $events,
        'clientOptions' => [
            'eventLimit' => TRUE,
            'theme' => true,
            'fixedWeekCount' => false,
            'eventClick' => new \yii\web\JsExpression("function(calEvent, jsEvent, view) {
                $.get('index.php?r=event/view', {'id': calEvent.id}, function (data) {
                    $('.modal').modal('show')
                            .find('#modelContent')
                            .html(data);
                });
            }"),
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
