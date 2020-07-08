<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account_number".
 *
 * @property int $id
 * @property int $company_id
 * @property int|null $bank_branch_id
 * @property string $account_number
 * @property int $is_main
 * @property float $stock
 * @property string|null $stock_date
 *
 * @property BankBranch $bankBranch
 * @property Company $company
 * @property Documents[] $documents
 * @property Files[] $files
 */
class AccountNumber123 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account_number';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'account_number'], 'required'],
            [['company_id', 'bank_branch_id',  'is_main'], 'integer'],
            [['stock'], 'number'],
            [['stock_date'], 'safe'],
            [['account_number'], 'string', 'max' => 20],
            [['bank_branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => BankBranch::className(), 'targetAttribute' => ['bank_branch_id' => 'id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'bank_branch_id' => 'Bank Branch ID',
            'account_number' => 'Account Number',
            'is_main' => 'Is Main',
            'stock' => 'Stock',
            'stock_date' => 'Stock Date',
        ];
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
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
    public function getBankbr()
    {
        return $this->hasOne(BankBranch::className(), ['id' => 'bank_branch_id']);
    }

    /**
     * Gets query for [[Documents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Documents::className(), ['account_number_id' => 'id']);
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['account_number_id' => 'id']);
    }
}
