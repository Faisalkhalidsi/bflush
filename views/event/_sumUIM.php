<?php

use yii\grid\GridView;
?>

<h4>NOSSF-UIM Activities</h4>
<hr>
<?=
GridView::widget([
    'id' => 'detailList',
    'dataProvider' => $dataProviderUIM,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'Title',
            'format' => 'raw',
            'value' => function ($dataProviderUIM) {
                return Html::a($dataProviderUIM->title, ['/event/view2', 'id' => $dataProviderUIM->id], ['target' => '_blank', 'data-pjax' => "0"]);
            },
        ],
        [
            'label' => 'Start Date',
            'value' => 'created_date',
        ],
    ],
]);
?>