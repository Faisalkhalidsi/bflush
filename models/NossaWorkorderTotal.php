<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nossa_workorder_total".
 *
 * @property int $id
 * @property int $workorder_total
 * @property string $waktu
 */
class NossaWorkorderTotal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nossa_workorder_total';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['workorder_total'], 'integer'],
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
            'workorder_total' => 'Workorder Total',
            'waktu' => 'Waktu',
        ];
    }
}
