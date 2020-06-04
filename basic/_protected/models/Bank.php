<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank".
 *
 * @property int $id
 * @property string $bank_name
 *
 * @property BankBranch[] $bankBranches
 */
class Bank extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bank';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bank_name'], 'required'],
            [['bank_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bank_name' => 'Bank Name',
        ];
    }

    /**
     * Gets query for [[BankBranches]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBankBranches()
    {
        return $this->hasMany(BankBranch::className(), ['bank_id' => 'id']);
    }
}
