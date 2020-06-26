<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "document".
 *
 * @property int $id
 * @property string $file_id
 * @property string|null $detail_date
 * @property string $detail_account
 * @property string $detail_inn
 * @property string $detail_name
 * @property string $detail_document_number
 * @property string $detail_mfo
 * @property string $detail_debet
 * @property string $detail_kredit
 * @property string $detail_purpose_of_payment
 * @property string $code_currency
 * @property string $contract_date
 */
class Document extends \yii\db\ActiveRecord
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
            [[ 'detail_account', 'detail_inn', 'detail_name', 'detail_document_number', 'detail_mfo', 'detail_debet', 'detail_kredit', 'detail_purpose_of_payment', 'code_currency', 'contract_date'], 'required'],
            [['file_id'], 'string', 'max' => 10],
            [['tip_deb_kred','file_id'], 'integer', 'max' => 11],
            [['detail_date'], 'datetime', 'max' => 50],
            [['detail_account'], 'string', 'max' => 20],
            [['detail_inn'], 'string', 'max' => 15],
            [['detail_name', 'detail_purpose_of_payment'], 'string', 'max' => 255],
            [['detail_document_number', 'detail_debet', 'detail_kredit', 'contract_date'], 'string', 'max' => 25],
            [['detail_mfo'], 'string', 'max' => 5],
            [['code_currency'], 'string', 'max' => 3],
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
            'detail_date' => 'Detail Date',
            'detail_account' => 'Detail Account',
            'detail_inn' => 'Detail Inn',
            'detail_name' => 'Detail Name',
            'detail_document_number' => 'Detail Document Number',
            'detail_mfo' => 'Detail Mfo',
            'detail_debet' => 'Detail Debet',
            'detail_kredit' => 'Detail Kredit',
            'detail_purpose_of_payment' => 'Detail Purpose Of Payment',
            'code_currency' => 'Code Currency',
            'contract_date' => 'Contract Date',
            'tip_deb_kred' => 'Tip deb kred'
        ];
    }
    public function beforeSave($insert)
{
    if ($insert) {

        ($this->detail_debet == 0) ? $this->tip_deb_kred = 0 : $this->tip_deb_kred = 1;

        return parent::beforeSave($insert);
    }
}

    public function getFileDoc()
    {
        return $this->hasOne(FileInfo::className(), ['id' => 'file_id']);
    }
}
