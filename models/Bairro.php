<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bairro".
 *
 * @property integer $idbairro
 * @property string $descricao
 *
 * @property Transporte[] $transportes
 */
class Bairro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bairro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'], 'required'],
            [['descricao'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idbairro' => 'Idbairro',
            'descricao' => 'Descricao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransportes()
    {
        return $this->hasMany(Transporte::className(), ['bairro_id' => 'idbairro']);
    }
}
