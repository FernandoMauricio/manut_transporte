<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transporte;

/**
 * TransporteSearch represents the model behind the search form about `app\models\Transporte`.
 */
class TransporteSearch extends Transporte
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tipo_solic_id', 'tipocarga_id', 'situacao_id', 'motorista_id', 'idusuario_solic', 'idusuario_suport'], 'integer'],
            [['data_solicitacao', 'bairro_id', 'descricao_transporte', 'local', 'data_prevista', 'hora_prevista', 'data_confirmacao', 'hora_confirmacao', 'usuario_solic_nome','usuario_suport_nome', 'tipo_carga_label', 'motorista_label', 'situacao_label'], 'safe'],
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
        $query = Transporte::find()
        ->orderBy(['id' => SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $dataProvider->sort->attributes['tipo_carga_label'] = [
        'asc' => ['tipo_carga.descricao' => SORT_ASC],
        'desc' => ['tipo_carga.descricao' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['motorista_label'] = [
        'asc' => ['motorista.descricao' => SORT_ASC],
        'desc' => ['motorista.descricao' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['situacao_label'] = [
        'asc' => ['situacao.nome' => SORT_ASC],
        'desc' => ['situacao.nome' => SORT_DESC],
        ];


        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('tipoCarga');
        $query->joinWith('bairro');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'data_solicitacao' => $this->data_solicitacao,
            //'bairro_id' => $this->bairro_id,
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


        $session = Yii::$app->session;

        $query->andFilterWhere(['cod_unidade_solic' => $session['sess_codunidade']])
            ->andFilterWhere(['like', 'descricao_transporte', $this->descricao_transporte])
            ->andFilterWhere(['like', 'local', $this->local])
            ->andFilterWhere(['like', 'usuario_solic_nome', $this->usuario_solic_nome])
            ->andFilterWhere(['=', 'motorista.descricao', $this->motorista_label])
            ->andFilterWhere(['=', 'situacao.nome', $this->situacao_label])
            ->andFilterWhere(['like', 'bairro.descricao', $this->bairro_id])
            ->andFilterWhere(['=', 'tipo_carga.descricao', $this->tipo_carga_label]);

        return $dataProvider;
    }
}
