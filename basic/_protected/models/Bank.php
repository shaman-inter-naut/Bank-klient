<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property BankBranch[] $bankBranches
 * @property FileTemplate[] $fileTemplates
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
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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

    /**
     * Gets query for [[FileTemplates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFileTemplates()
    {
        return $this->hasMany(FileTemplate::className(), ['bank_id' => 'id']);
    }
}
