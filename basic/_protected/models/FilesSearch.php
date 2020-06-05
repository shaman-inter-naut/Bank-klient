<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Files;

/**
 * FilesSearch represents the model behind the search form of `app\models\Files`.
 */
class FilesSearch extends Files
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_inn', 'bank_mfo', 'company_account_number', 'code_currency', 'period', 'first_sum', 'last_sum', 'debit', 'credit', 'account_number_id', 'currency_id'], 'integer'],
            [['file_date'], 'safe'],
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
        $query = Files::find();

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
            'company_inn' => $this->company_inn,
            'bank_mfo' => $this->bank_mfo,
            'company_account_number' => $this->company_account_number,
            'code_currency' => $this->code_currency,
            'period' => $this->period,
            'first_sum' => $this->first_sum,
            'last_sum' => $this->last_sum,
            'debit' => $this->debit,
            'credit' => $this->credit,
            'account_number_id' => $this->account_number_id,
            'currency_id' => $this->currency_id,
        ]);

        $query->andFilterWhere(['like', 'file_date', $this->file_date]);

        return $dataProvider;
    }
}
