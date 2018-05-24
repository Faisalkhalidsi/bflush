<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nossa_status_integrasi".
 *
 * @property int $id
 * @property string $integration_type
 * @property int $queue
 * @property string $waktu
 */
class NossaStatusIntegrasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nossa_status_integrasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['queue'], 'integer'],
            [['waktu'], 'safe'],
            [['integration_type'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'integration_type' => 'Integration Type',
            'queue' => 'Queue',
            'waktu' => 'Waktu',
        ];
    }
}
