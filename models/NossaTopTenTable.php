<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nossa_top_ten_table".
 *
 * @property int $id
 * @property string $table_name
 * @property int $rows_total
 * @property string $last_analyzed
 */
class NossaTopTenTable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nossa_top_ten_table';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rows_total'], 'integer'],
            [['last_analyzed'], 'safe'],
            [['table_name'], 'string', 'max' => 50],
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
