<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Xujjat;


/**
 * XujjatSearch represents the model behind the search form of `app\models\Xujjat`.
 */


class XujjatSearch extends Xujjat
{
    /**
     * {@inheritdoc}
     */
    public $file;
    public $from_date;
    public $to_date;

//    public $companyAccount;
//    public $inn;

    public function rules()
    {
        return [
            [['id',  'expence_type_id', 'tip_deb_kred',], 'integer'],
            [['from_date','to_date','detail_date','file_id', 'filecom_id', 'period_id','inn_id','data_id', 'company_account_id','detail_account',
                'detail_inn', 'detail_partner_unique_code', 'detail_name', 'detail_document_number', 'detail_mfo',
                'detail_debet', 'detail_kredit', 'detail_purpose_of_payment', 'code_currency', 'contract_date'], 'safe'],
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
        $query = Xujjat::find();

//        $query->joinWith(['companyAccount']);
//        $query->joinWith(['inn']);
        $query->joinWith('file');
        $query->joinWith('file');

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

        $query->joinWith('file');
        $query->joinWith('file.company');
//        $query->joinWith(['companyAccount']);
//        $query->joinWith(['inn']);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
//            'file.company_inn' => $this->file_id,
            'expence_type_id' => $this->expence_type_id,
            'tip_deb_kred' => $this->tip_deb_kred,
//            'company_account_id' => $this->company_account_id,
        ]);

//        $query->andFilterWhere(['like', 'detail_date', $this->detail_date])
//            ->andFilterWhere(['like', 'detail_account', $this->detail_account])
        $query->andFilterWhere(['like', 'detail_account', $this->detail_account])
            ->andFilterWhere(['like', 'detail_inn', $this->detail_inn])
            ->andFilterWhere(['like', 'detail_partner_unique_code', $this->detail_partner_unique_code])
            ->andFilterWhere(['like', 'detail_name', $this->detail_name])
            ->andFilterWhere(['like', 'detail_document_number', $this->detail_document_number])
            ->andFilterWhere(['like', 'detail_mfo', $this->detail_mfo])
            ->andFilterWhere(['like', 'detail_debet', $this->detail_debet])
            ->andFilterWhere(['like', 'detail_kredit', $this->detail_kredit])
            ->andFilterWhere(['like', 'detail_purpose_of_payment', $this->detail_purpose_of_payment])
            ->andFilterWhere(['like', 'code_currency', $this->code_currency])
            ->andFilterWhere(['like', 'contract_date', $this->contract_date]);


            $query->andFilterWhere(['like', 'file_info.bank_mfo', $this->file_id]);
            $query->andFilterWhere(['like', 'file_info.company_account', $this->company_account_id]);
            $query->andFilterWhere(['like', 'file_info.company_inn', $this->inn_id]);
            $query->andFilterWhere(['like', 'file_info.file_date', $this->data_id]);
            $query->andFilterWhere(['like', 'file_info.data_period', $this->period_id]);
            $query->andFilterWhere(['like', 'file_info.file.company.short_name,', $this->filecom_id]);


            $query->andFilterWhere(['and',['>','detail_date',$this->detail_date], ['<','detail_date', $this->detail_date]]);


        return $dataProvider;
    }
}
