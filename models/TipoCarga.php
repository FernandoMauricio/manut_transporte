<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_carga".
 *
 * @property integer $idtipo_carga
 * @property string $descricao
 *
 * @property Transporte[] $transportes
 */
class TipoCarga extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_carga';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtipo_carga' => 'Idtipo Carga',
            'descricao' => 'Tipo de Carga',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransportes()
    {
        return $this->hasMany(Transporte::className(), ['tipocarga_id' => 'idtipo_carga']);
    }
}
