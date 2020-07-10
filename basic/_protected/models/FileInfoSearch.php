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
            [['id', 'countDetailToRecord', 'countDetailNoRecord'], 'integer'],
            [['depozitAfter', 'depozitBefore', 'bank_mfo', 'company_account', 'company_inn', 'file_name', 'file_date', 'doc','data_period_start', 'data_period_end'], 'safe'],
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
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

//        $query->joinWith('doc');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
//            'tip_deb_kred' => $this->tip_deb_kred,
        ]);

        $query->andFilterWhere(['like', 'bank_mfo', $this->bank_mfo])
            ->andFilterWhere(['like', 'company_account', $this->company_account])
            ->andFilterWhere(['like', 'company_inn', $this->company_inn])
            ->andFilterWhere(['like', 'file_name', $this->file_name])
            ->andFilterWhere(['like', 'file_date', $this->file_date])
            ->andFilterWhere(['like', 'data_period_start', $this->data_period_start])
            ->andFilterWhere(['like', 'data_period_end', $this->data_period_end])
            ->andFilterWhere(['like', 'depozitAfter', $this->depozitAfter])
            ->andFilterWhere(['like', 'depozitBefore', $this->depozitBefore])
            ->andFilterWhere(['like', 'countDetailToRecord', $this->countDetailToRecord])
            ->andFilterWhere(['like', 'countDetailNoRecord', $this->countDetailNoRecord]);
//        $query->andFilterWhere(['like','doc.tip_deb_kred', $this->id]);

        return $dataProvider;
    }

}
