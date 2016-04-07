<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "situacao".
 *
 * @property integer $id
 * @property string $nome
 *
 * @property Transporte[] $transportes
 */
class Situacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'situacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Situação',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransportes()
    {
        return $this->hasMany(Transporte::className(), ['situacao_id' => 'id']);
    }
}
