<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contracts;
use app\models\Company;

/**
 * ContractsSearch represents the model behind the search form of `app\models\Contracts`.
 */
class ContractsSearch extends Contracts
{
    /**
     * {@inheritdoc}
     */
    public $firstCompany;
    public $secondCompany;
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['contract_date', 'file', 'contract_number', 'secondCompany', 'companyAccount','first_company_id', 'second_company_id'], 'safe'],
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
        $query = Contracts::find();
//        $query->leftJoin('company', 'company');
//        $query = Contracts::find()->joinWith(['secondCompany','firstCompany']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

//        $dataProvider->sort->attributes['first_company_id']=[
//          'asc'=>['company.name'=>SORT_ASC],
//          'desc'=>['company.name'=>SORT_DESC],
//        ];

        $this->load($params);
//        $query->andFilterWhere(['status' => 1]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        if ($this->first_company_id){
            $query->joinWith('firstCompany');
        }
        $query->joinWith('secondCompany');
//        $query->joinWith(['firstCompany','secondCompany']);


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
//            'company.name' => $this->first_company_id,
//            'secondCompany.name' => $this->second_company_id,
            'contract_number' => $this->contract_number,
            'contract_date' => $this->contract_date,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like','company.name', $this->first_company_id]);
        $query->andFilterWhere(['like','company.name', $this->second_company_id]);

        return $dataProvider;
    }
}
