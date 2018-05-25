<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nossa_session_appl".
 *
 * @property int $id
 * @property string $server_name
 * @property int $session_total
 * @property string $status
 * @property string $waktu
 */
class NossaSessionAppl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nossa_session_appl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['session_total'], 'integer'],
            [['waktu'], 'safe'],
            [['server_name', 'status'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'server_name' => 'Server Name',
            'session_total' => 'Session Total',
            'status' => 'Status',
            'waktu' => 'Waktu',
        ];
    }
}
