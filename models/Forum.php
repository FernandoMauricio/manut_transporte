<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "forum".
 *
 * @property integer $id
 * @property string $mensagem
 * @property string $data
 * @property integer $usuario_id
 * @property integer $solicitacao_id
 *
 * @property Transporte $solicitacao
 */
class Forum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'forum';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mensagem', 'data', 'usuario_id', 'solicitacao_id'], 'required'],
            [['mensagem'], 'string'],
            [['data'], 'safe'],
            [['usuario_id', 'solicitacao_id'], 'integer'],
            [['solicitacao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transporte::className(), 'targetAttribute' => ['solicitacao_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mensagem' => 'Mensagem',
            'data' => 'Data',
            'usuario_id' => 'Usuario ID',
            'solicitacao_id' => 'Solicitacao ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitacao()
    {
        return $this->hasOne(Transporte::className(), ['id' => 'solicitacao_id']);
    }
}
