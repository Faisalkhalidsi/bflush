<?php
use yii\grid\GridView;
?>
    

<h4>NOSSF-OSM Activities</h4>
<hr>
<?=
GridView::widget([
    'id' => 'detailList',
    'dataProvider' => $dataProviderOSM,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'Title',
            'format' => 'raw',
            'value' => function ($dataProviderOSM) {
                return Html::a($dataProviderOSM->title, ['/event/view2', 'id' => $dataProviderOSM->id], ['target' => '_blank', 'data-pjax' => "0"]);
            },
        ],
        [
            'label' => 'Start Date',
            'value' => 'created_date',
        ],
    ],
]);
?>