<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nossf_uim_top_ten".
 *
 * @property int $id
 * @property string $table_name
 * @property int $rows_total
 * @property string $last_analyzed
 */
class NossfUimTopTen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nossf_uim_top_ten';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rows_total'], 'integer'],
            [['last_analyzed'], 'safe'],
            [['table_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table_name' => 'Table Name',
            'rows_total' => 'Rows Total',
            'last_analyzed' => 'Last Analyzed',
        ];
    }
}
