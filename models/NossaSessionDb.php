<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nossa_session_db".
 *
 * @property int $id
 * @property string $machine_name
 * @property int $inst_id
 * @property int $session_total
 * @property string $status
 * @property string $waktu
 */
class NossaSessionDb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nossa_session_db';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inst_id', 'session_total'], 'integer'],
            [['waktu'], 'safe'],
            [['machine_name', 'status'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'machine_name' => 'Machine Name',
            'inst_id' => 'Inst ID',
            'session_total' => 'Session Total',
            'status' => 'Status',
            'waktu' => 'Waktu',
        ];
    }
}
