<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank_branch".
 *
 * @property int $id
 * @property string|null $name_branch
 * @property int|null $mfo
 * @property int|null $bank_id
 *
 * @property AccountNumber[] $accountNumbers
 * @property Bank $bank
 * @property Documents[] $documents
 */
class BankBranch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bank_branch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mfo'], 'required'],
            [['mfo', 'bank_id'], 'integer'],
            [['name_branch'], 'string', 'max' => 255],
            [['short_name'], 'string', 'max' => 255],
            [['bank_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bank::className(), 'targetAttribute' => ['bank_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_branch' => 'Name Branch',
            'mfo' => 'Mfo',
            'bank_id' => 'Bank ID',
            'short_name' => 'Short name',
        ];
    }

    /**
     * Gets query for [[AccountNumbers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccountNumbers()
    {
        return $this->hasMany(AccountNumber::className(), ['bank_branch_id' => 'id']);
    }

    /**
     * Gets query for [[Bank]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBank()
    {
        return $this->hasOne(Bank::className(), ['id' => 'bank_id']);
    }

    /**
     * Gets query for [[Documents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Documents::className(), ['bank_branch_id' => 'id']);
    }
    public function getCompany()
        {
            return $this->hasOne(Company::className(), ['bank_branch_id' => 'id']);
        }
}
