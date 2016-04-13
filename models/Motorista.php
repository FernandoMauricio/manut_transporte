<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "motorista".
 *
 * @property integer $id
 * @property string $descricao
 *
 * @property Transporte[] $transportes
 */
class Motorista extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'motorista';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'], 'string', 'max' => 45],
            [['status'], 'integer'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Motorista',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransportes()
    {
        return $this->hasMany(Transporte::className(), ['motorista_id' => 'id']);
    }
}
