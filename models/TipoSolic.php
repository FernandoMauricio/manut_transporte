<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_solic".
 *
 * @property integer $id
 * @property string $descricao
 *
 * @property Transporte[] $transportes
 */
class TipoSolic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_solic';
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
            'id' => 'ID',
            'descricao' => 'Tipo de Solicitação',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransportes()
    {
        return $this->hasMany(Transporte::className(), ['tipo_solic_id' => 'id']);
    }
}
