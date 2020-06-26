<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string|null $name
 * @property string $short_name
 * @property int|null $inn
 * @property int $accaunt_begin
 * @property int|null $unical_code
 *
 * @property AccountNumber[] $accountNumbers
 * @property Contracts[] $contracts
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['short_name', 'accaunt_begin'], 'required'],
            [['inn', 'accaunt_begin', 'unical_code'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['short_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'short_name' => 'Short Name',
            'inn' => 'Inn',
            'accaunt_begin' => 'Accaunt Begin',
            'unical_code' => 'Unical Code',
        ];
    }

    /**
     * Gets query for [[AccountNumbers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccountnumbers()
    {
        return $this->hasMany(AccountNumber::className(), ['company_id' => 'id']);
    }

    /**
     * Gets query for [[Contracts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContracts()
    {
        return $this->hasMany(Contracts::className(), ['company_id' => 'id']);
    }
    public function getBankBranch()
    {
        return $this->hasMany(BankBranch::className(), ['company_id' => 'id']);
    }


//    public function getSecondCompany()
//    {
//        return $this->hasOne(Company::className(), ['id' => 'second_company_id']);
//    }

}
