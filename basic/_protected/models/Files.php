<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property int|null $company_inn
 * @property int|null $bank_mfo
 * @property int|null $company_account_number
 * @property string|null $file_date
 * @property int|null $code_currency
 * @property int|null $period
 * @property int|null $first_sum
 * @property int|null $last_sum
 * @property int|null $debit
 * @property int|null $credit
 * @property int|null $account_number_id
 * @property int|null $currency_id
 *
 * @property AccountNumber $accountNumber
 * @property Currency $currency
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_inn', 'bank_mfo', 'company_account_number', 'code_currency', 'period', 'first_sum', 'last_sum', 'debit', 'credit', 'account_number_id', 'currency_id'], 'integer'],
            [['file_date'], 'string', 'max' => 255],
            [['account_number_id'], 'exist', 'skipOnError' => true, 'targetClass' => AccountNumber::className(), 'targetAttribute' => ['account_number_id' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_inn' => 'Company Inn',
            'bank_mfo' => 'Bank Mfo',
            'company_account_number' => 'Company Account Number',
            'file_date' => 'File Date',
            'code_currency' => 'Code Currency',
            'period' => 'Period',
            'first_sum' => 'First Sum',
            'last_sum' => 'Last Sum',
            'debit' => 'Debit',
            'credit' => 'Credit',
            'account_number_id' => 'Account Number ID',
            'currency_id' => 'Currency ID',
        ];
    }

    /**
     * Gets query for [[AccountNumber]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccountNumber()
    {
        return $this->hasOne(AccountNumber::className(), ['id' => 'account_number_id']);
    }

    /**
     * Gets query for [[Currency]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }
}
