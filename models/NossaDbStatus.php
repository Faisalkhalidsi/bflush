<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nossa_db_status".
 *
 * @property int $id
 * @property string $hostname
 * @property string $uptime
 * @property string $instance_name
 * @property string $status
 */
class NossaDbStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nossa_db_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uptime'], 'safe'],
            [['hostname', 'instance_name', 'status'], 'string', 'max' => 100],
            [['hostname', 'uptime', 'instance_name', 'status'], 'unique', 'targetAttribute' => ['hostname', 'uptime', 'instance_name', 'status']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hostname' => 'Hostname',
            'uptime' => 'Uptime',
            'instance_name' => 'Instance Name',
            'status' => 'Status',
        ];
    }
}
