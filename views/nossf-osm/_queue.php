<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\grid\GridView;
?>
    <?=

    GridView::widget([
        'id'=>'queueList',
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            'task_description',
            'queued',
            'waktu',
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>