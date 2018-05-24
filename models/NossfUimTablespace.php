<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nossf_uim_tablespace".
 *
 * @property int $id
 * @property string $tablespace_name
 * @property double $free_tablespace
 * @property double $total_tablespace
 * @property string $waktu
 */
class NossfUimTablespace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nossf_uim_tablespace';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['free_tablespace', 'total_tablespace'], 'number'],
            [['waktu'], 'safe'],
            [['tablespace_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tablespace_name' => 'Tablespace Name',
            'free_tablespace' => 'Free Tablespace',
            'total_tablespace' => 'Total Tablespace',
            'waktu' => 'Waktu',
        ];
    }
}
