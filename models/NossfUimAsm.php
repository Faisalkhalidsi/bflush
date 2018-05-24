<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nossf_uim_asm".
 *
 * @property int $id
 * @property string $asm_name
 * @property double $free_asm
 * @property double $total_asm
 * @property string $waktu
 */
class NossfUimAsm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nossf_uim_asm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['free_asm', 'total_asm'], 'number'],
            [['waktu'], 'safe'],
            [['asm_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'asm_name' => 'Asm Name',
            'free_asm' => 'Free Asm',
            'total_asm' => 'Total Asm',
            'waktu' => 'Waktu',
        ];
    }
}
