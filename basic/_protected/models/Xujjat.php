<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "document".
 *
 * @property int $id
 * @property int $file_id
 * @property int|null $expence_type_id
 * @property string|null $detail_date
 * @property string $detail_account
 * @property string $detail_inn
 * @property string $detail_partner_unique_code
 * @property string $detail_name
 * @property string $detail_document_number
 * @property string $detail_mfo
 * @property string $detail_debet
 * @property string $detail_kredit
 * @property string $detail_purpose_of_payment
 * @property string $code_currency
 * @property string $contract_date
 * @property int|null $tip_deb_kred
 * @property int|null $company_account_id
 *
 * @property FileInfo $companyAccount
 * @property FileInfo $file
 */
class Xujjat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['detail_account', 'detail_inn', 'detail_partner_unique_code', 'detail_name', 'detail_document_number',
                'detail_mfo', 'detail_debet', 'detail_kredit', 'detail_purpose_of_payment', 'code_currency', 'contract_date'], 'required'],
            [['file_id','filecom_id', 'expence_type_id', 'tip_deb_kred', 'company_account_id','inn_id','data_id','period_id'], 'integer'],
            [['filecom_id','detail_purpose_of_payment'], 'string'],
            [['detail_date', 'detail_mfo'], 'string', 'max' => 50],
            [['detail_account'], 'string', 'max' => 20],
            [['detail_inn'], 'string', 'max' => 15],
            [['detail_partner_unique_code'], 'string', 'max' => 8],
            [['detail_name'], 'string', 'max' => 255],
            [['detail_document_number', 'detail_debet', 'detail_kredit', 'contract_date'], 'string', 'max' => 25],
            [['code_currency'], 'string', 'max' => 3],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => FileInfo::className(), 'targetAttribute' => ['file_id' => 'id']],
            [['company_account_id'], 'exist', 'skipOnError' => true, 'targetClass' => FileInfo::className(), 'targetAttribute' => ['company_account_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_id' => 'File ID',
            'expence_type_id' => 'Expence Type ID',
            'detail_date' => 'Detail Date',
            'detail_account' => 'Detail Account',
            'detail_inn' => 'Detail Inn',
            'detail_partner_unique_code' => 'Detail Partner Unique Code',
            'detail_name' => 'Detail Name',
            'detail_document_number' => 'Detail Document Number',
            'detail_mfo' => 'Detail Mfo',
            'detail_debet' => 'Detail Debet',
            'detail_kredit' => 'Detail Kredit',
            'detail_purpose_of_payment' => 'Detail Purpose Of Payment',
            'code_currency' => 'Code Currency',
            'contract_date' => 'Contract Date',
            'tip_deb_kred' => 'Tip Deb Kred',
            'company_account_id' => 'Company Account ID',
            'inn_id' => 'Inn ID',
            'data_id' => 'Data ID',
            'period_id' => 'Period ID',
            'filecom_id' => 'FileCom ID'
        ];
    }

    /**
     * Gets query for [[CompanyAccount]].
     *
     * @return \yii\db\ActiveQuery
     */

    public function getCompanyAccount()
    {
        return $this->hasOne(FileInfo::className(), ['id' => 'company_account_id']);
    }

    /**
     * Gets query for [[File]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(FileInfo::className(), ['id' => 'file_id']);
    }
    public function getFilecom()
    {
        return $this->hasOne(FileInfo::className(), ['id' => 'filecom_id']);
    }
//    public function getInn()
//    {
//        return $this->hasOne(FileInfo::className(), ['id' => 'inn_id']);
//    }
//    public function getData()
//    {
//        return $this->hasOne(FileInfo::className(), ['id' => 'data_id']);
//    }
//    public function beforeSave($inser)
//    {
//        if ($inser) {
//
//            $this->company_account_id = $this->file_id;
//            $this->inn_id = $this->file_id;
//            $this->data_id = $this->file_id;
//            $this->period_id = $this->file_id;
//
//            return parent::beforeSave($inser);
//        }
//    }
}
