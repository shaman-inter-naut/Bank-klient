<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Documents;

/**
 * DocumentsSearch represents the model behind the search form of `app\models\Documents`.
 */
class DocumentsSearch extends Documents
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'file_id', 'tip_deb_kred'], 'integer'],
            [['detail_date', 'detail_account', 'detail_inn', 'detail_name', 'detail_document_number', 'detail_mfo', 'detail_debet', 'detail_kredit', 'detail_purpose_of_payment', 'code_currency', 'contract_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Documents::find();

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
            'file_id' => $this->file_id,
            'tip_deb_kred' => $this->tip_deb_kred,
        ]);

        $query->andFilterWhere(['like', 'detail_date', $this->detail_date])
            ->andFilterWhere(['like', 'detail_account', $this->detail_account])
            ->andFilterWhere(['like', 'detail_inn', $this->detail_inn])
            ->andFilterWhere(['like', 'detail_name', $this->detail_name])
            ->andFilterWhere(['like', 'detail_document_number', $this->detail_document_number])
            ->andFilterWhere(['like', 'detail_mfo', $this->detail_mfo])
            ->andFilterWhere(['like', 'detail_debet', $this->detail_debet])
            ->andFilterWhere(['like', 'detail_kredit', $this->detail_kredit])
            ->andFilterWhere(['like', 'detail_purpose_of_payment', $this->detail_purpose_of_payment])
            ->andFilterWhere(['like', 'code_currency', $this->code_currency])
            ->andFilterWhere(['like', 'contract_date', $this->contract_date]);

        return $dataProvider;
    }
}
