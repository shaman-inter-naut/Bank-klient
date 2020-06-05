<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documents".
 *
 * @property int $id
 * @property int|null $inn_company
 * @property int|null $mfo_bank
 * @property int|null $account_number_company
 * @property string|null $date
 * @property int|null $document_number
 * @property int|null $mfo_branch
 * @property int|null $inn_branch
 * @property string|null $name_branch
 * @property int|null $account_number_branch
 * @property string|null $purpose_branch
 * @property int|null $code_currency
 * @property int|null $kirim
 * @property int|null $chiqim
 * @property int|null $tip_k_ch
 * @property string|null $contract_date
 * @property int|null $contract_number
 * @property int|null $contracts_id
 * @property int|null $currency_id
 * @property int|null $account_number_id
 * @property int|null $bank_branch_id
 *
 * @property AccountNumber $accountNumber
 * @property BankBranch $bankBranch
 * @property Contracts $contracts
 * @property Currency $currency
 */
class Documents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inn_company', 'mfo_bank', 'account_number_company', 'document_number', 'mfo_branch', 'inn_branch', 'account_number_branch', 'code_currency', 'kirim', 'chiqim', 'tip_k_ch', 'contract_number', 'contracts_id', 'currency_id', 'account_number_id', 'bank_branch_id'], 'integer'],
            [['date', 'name_branch', 'purpose_branch', 'contract_date'], 'string', 'max' => 255],
            [['account_number_id'], 'exist', 'skipOnError' => true, 'targetClass' => AccountNumber::className(), 'targetAttribute' => ['account_number_id' => 'id']],
            [['bank_branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => BankBranch::className(), 'targetAttribute' => ['bank_branch_id' => 'id']],
            [['contracts_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contracts::className(), 'targetAttribute' => ['contracts_id' => 'id']],
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
            'inn_company' => 'Inn Company',
            'mfo_bank' => 'Mfo Bank',
            'account_number_company' => 'Account Number Company',
            'date' => 'Date',
            'document_number' => 'Document Number',
            'mfo_branch' => 'Mfo Branch',
            'inn_branch' => 'Inn Branch',
            'name_branch' => 'Name Branch',
            'account_number_branch' => 'Account Number Branch',
            'purpose_branch' => 'Purpose Branch',
            'code_currency' => 'Code Currency',
            'kirim' => 'Kirim',
            'chiqim' => 'Chiqim',
            'tip_k_ch' => 'Tip K Ch',
            'contract_date' => 'Contract Date',
            'contract_number' => 'Contract Number',
            'contracts_id' => 'Contracts ID',
            'currency_id' => 'Currency ID',
            'account_number_id' => 'Account Number ID',
            'bank_branch_id' => 'Bank Branch ID',
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
     * Gets query for [[BankBranch]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBankBranch()
    {
        return $this->hasOne(BankBranch::className(), ['id' => 'bank_branch_id']);
    }

    /**
     * Gets query for [[Contracts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContracts()
    {
        return $this->hasOne(Contracts::className(), ['id' => 'contracts_id']);
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
