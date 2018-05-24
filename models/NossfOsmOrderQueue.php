<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nossf_osm_order_queue".
 *
 * @property int $id
 * @property string $flow
 * @property string $task_description
 * @property int $queued
 * @property string $waktu
 */
class NossfOsmOrderQueue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nossf_osm_order_queue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['flow', 'task_description', 'queued'], 'required'],
            [['queued'], 'integer'],
            [['waktu'], 'safe'],
            [['flow', 'task_description'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'flow' => 'Flow',
            'task_description' => 'Task Description',
            'queued' => 'Queued',
            'waktu' => 'Waktu',
        ];
    }
}
