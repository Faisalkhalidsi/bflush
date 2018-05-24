<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nossa_session_db_total".
 *
 * @property int $id
 * @property int $session_total
 * @property string $waktu
 */
class NossaSessionDbTotal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nossa_session_db_total';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['session_total'], 'integer'],
            [['waktu'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'session_total' => 'Session Total',
            'waktu' => 'Waktu',
        ];
    }
}
