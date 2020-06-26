<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contracts".
 *
 * @property int $id
 * @property int $first_company_id
 * @property int $second_company_id
 * @property int|null $contract_number
 * @property string $contract_date
 *
 * @property Documents[] $documents
 * @property Company $firstCompany
 */

class Contracts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'contracts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_company_id', 'second_company_id'], 'required'],
            [['first_company_id', 'second_company_id', 'contract_number', 'status'], 'integer'],
            [['contract_date'], 'safe'],
//            [['contract_date'], 'string'],
            [['first_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['first_company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_company_id' => 'First Company ID',
            'second_company_id' => 'Second Company ID',
            'contract_number' => 'Contract Number',
            'contract_date' => 'Contract Date',
            'status' => 'Status'
        ];
    }

    /**
     * Gets query for [[Documents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Documents::className(), ['contracts_id' => 'id']);
    }

    /**
     * Gets query for [[FirstCompany]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFirstCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'first_company_id']);
    }
    public function getSecondCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'second_company_id']);
    }
}
