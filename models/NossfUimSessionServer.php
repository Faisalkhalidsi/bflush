<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nossf_uim_session_server".
 *
 * @property int $id
 * @property string $machine_name
 * @property int $session_total
 * @property string $waktu
 */
class NossfUimSessionServer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nossf_uim_session_server';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['session_total'], 'integer'],
            [['waktu'], 'safe'],
            [['machine_name'], 'string', 'max' => 100],
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
            'session_total' => 'Session Total',
            'waktu' => 'Waktu',
        ];
    }
}
