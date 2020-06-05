<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file_template".
 *
 * @property int $id
 * @property int|null $bank_id
 * @property int|null $in_address
 * @property int|null $mfo_address
 * @property int|null $hr_address
 * @property string|null $date_address
 * @property int|null $file_number_address
 *
 * @property Bank $bank
 */
class Filetemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file_template';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bank_id', 'in_address', 'mfo_address', 'hr_address', 'file_number_address'], 'integer'],
            [['date_address'], 'string', 'max' => 255],
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
            'bank_id' => 'Bank ID',
            'in_address' => 'In Address',
            'mfo_address' => 'Mfo Address',
            'hr_address' => 'Hr Address',
            'date_address' => 'Date Address',
            'file_number_address' => 'File Number Address',
        ];
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
}
