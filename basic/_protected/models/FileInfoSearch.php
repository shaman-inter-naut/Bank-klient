<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FileInfo;

/**
 * FileInfoSearch represents the model behind the search form of `app\models\FileInfo`.
 */
class FileInfoSearch extends FileInfo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['bank_mfo', 'company_account', 'company_inn', 'file_name', 'file_date', 'data_period'], 'safe'],
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
        $query = FileInfo::find();

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
        ]);

        $query->andFilterWhere(['like', 'bank_mfo', $this->bank_mfo])
            ->andFilterWhere(['like', 'company_account', $this->company_account])
            ->andFilterWhere(['like', 'company_inn', $this->company_inn])
            ->andFilterWhere(['like', 'file_name', $this->file_name])
            ->andFilterWhere(['like', 'file_date', $this->file_date])
            ->andFilterWhere(['like', 'data_period', $this->data_period]);

        return $dataProvider;
    }
}