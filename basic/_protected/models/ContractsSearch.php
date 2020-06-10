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
    public function rules()
    {
        return [
            [['id', 'contract_number'], 'integer'],
            [['contract_date', 'firstCompany', 'first_company_id', 'second_company_id'], 'safe'],
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

//
//    public function search($params)
//    {
//        $query = Contracts::find()->leftJoin(Company::tableName(), 'expenses.iddepartment = departments.id')->where($params);
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//            'pagination' => [
//                'pagesize' => 50,    //Alternate method of disabling paging
//            ],
//            'sort' => [
//                'attributes' => [
//                    'name' => [
//                        'asc' => ['name' => SORT_ASC,],
//                        'desc' => ['name' => SORT_DESC,],
//                    ],
//                    'type' => [
//                        'asc' => ['type' => SORT_ASC,],
//                        'desc' => ['type' => SORT_DESC,],
//                    ],
//                    'price' => [
//                        'asc' => ['price' => SORT_ASC,],
//                        'desc' => ['price' => SORT_DESC,],
//                    ],
//                    'departments.name' => [
//                        'asc' => ['departments.name' => SORT_ASC,],
//                        'desc' => ['departments.name' => SORT_DESC,],
//                    ],
////                    'expenses.name' => [
////                        'asc' => ['expenses.name' => SORT_ASC,],
////                        'desc' => ['expenses.name' => SORT_DESC,],
////                    ],
//                    'date' => [
//                        'asc' => ['date' => SORT_ASC,],
//                        'desc' => ['date' => SORT_DESC,],
//                    ],
//                ],
//            ],
//        ]);
//
//        return $dataProvider;
//    }



    public function search($params)
    {
        $query = Contracts::find();

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

        $query->joinWith('firstCompany');
        $query->joinWith('secondCompany');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
//            'first_company_id' => $this->first_company_id,
//            'second_company_id' => $this->second_company_id,
            'contract_number' => $this->contract_number,
            'contract_date' => $this->contract_date,
        ]);

        $query->andFilterWhere(['like','company.name', $this->first_company_id]);
        $query->andFilterWhere(['like','company.name', $this->second_company_id]);

        return $dataProvider;
    }
}
