<?php
use yii\grid\GridView;
?>
<h4>NOSSA Activities</h4>
<hr>
<?=
GridView::widget([
    'id' => 'detailList',
    'dataProvider' => $dataProviderNOSSA,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'Title',
            'format' => 'raw',
            'value' => function ($dataProviderNOSSA) {
                return Html::a($dataProviderNOSSA->title, ['/event/view2', 'id' => $dataProviderNOSSA->id], ['target' => '_blank', 'data-pjax' => "0"]);
            },
        ],
        [
            'label' => 'Start Date',
            'value' => 'created_date',
        ],
    ],
]);
?>