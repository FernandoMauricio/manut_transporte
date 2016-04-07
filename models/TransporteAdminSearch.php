<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TransporteAdmin;

/**
 * TransporteAdminSearch represents the model behind the search form about `app\models\TransporteAdmin`.
 */
class TransporteAdminSearch extends TransporteAdmin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bairro_id', 'tipo_solic_id', 'tipocarga_id', 'situacao_id', 'motorista_id', 'idusuario_solic', 'idusuario_suport'], 'integer'],
            [['data_solicitacao', 'descricao_transporte', 'local', 'data_prevista', 'hora_prevista', 'data_confirmacao', 'hora_confirmacao', 'usuario_solic_nome', 'usuario_suport_nome'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TransporteAdmin::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'data_solicitacao' => $this->data_solicitacao,
            'bairro_id' => $this->bairro_id,
            'data_prevista' => $this->data_prevista,
            'hora_prevista' => $this->hora_prevista,
            'data_confirmacao' => $this->data_confirmacao,
            'hora_confirmacao' => $this->hora_confirmacao,
            'tipo_solic_id' => $this->tipo_solic_id,
            'tipocarga_id' => $this->tipocarga_id,
            'situacao_id' => $this->situacao_id,
            'motorista_id' => $this->motorista_id,
            'idusuario_solic' => $this->idusuario_solic,
            'idusuario_suport' => $this->idusuario_suport,
        ]);

        $query->andFilterWhere(['like', 'descricao_transporte', $this->descricao_transporte])
            ->andFilterWhere(['like', 'local', $this->local])
            ->andFilterWhere(['like', 'usuario_solic_nome', $this->usuario_solic_nome])
            ->andFilterWhere(['like', 'usuario_suport_nome', $this->usuario_suport_nome]);

        return $dataProvider;
    }
}
