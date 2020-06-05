<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Filetemplate;

/**
 * FiletemplateSearch represents the model behind the search form of `app\models\Filetemplate`.
 */
class FiletemplateSearch extends Filetemplate
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'bank_id', 'in_address', 'mfo_address', 'hr_address', 'file_number_address'], 'integer'],
            [['date_address'], 'safe'],
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
        $query = Filetemplate::find();

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
            'bank_id' => $this->bank_id,
            'in_address' => $this->in_address,
            'mfo_address' => $this->mfo_address,
            'hr_address' => $this->hr_address,
            'file_number_address' => $this->file_number_address,
        ]);

        $query->andFilterWhere(['like', 'date_address', $this->date_address]);

        return $dataProvider;
    }
}
