<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $company_name
 * @property string $company_short_name
 * @property string $company_inn
 * @property string $company_schyot
 * @property string $company_bank_kodi
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
            [['company_name', 'company_short_name', 'company_inn', 'company_schyot', 'company_bank_kodi'], 'required'],
            [['company_name', 'company_short_name'], 'string', 'max' => 255],
            [['company_inn'], 'string', 'max' => 9],
            [['company_schyot'], 'string', 'max' => 20],
            [['company_bank_kodi'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_name' => 'Company Name',
            'company_short_name' => 'Company Short Name',
            'company_inn' => 'Company Inn',
            'company_schyot' => 'Company Schyot',
            'company_bank_kodi' => 'Company Bank Kodi',
        ];
    }
}
