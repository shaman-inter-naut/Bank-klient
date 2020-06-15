<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file_info".
 *
 * @property int $id
 * @property string $bank_mfo
 * @property string $company_account
 * @property string $company_inn
 * @property string $file_name
 * @property string $file_date
 * @property string $data_period
 */
class FileInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $file;


    public static function tableName()
    {
        return 'file_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file'], 'required'],
            [['bank_mfo'], 'string', 'max' => 10],
            [['company_account', 'data_period'], 'string', 'max' => 50],
            [['company_inn', 'file_date'], 'string', 'max' => 25],
            [['file_name'], 'string', 'max' => 255],
            [['file'], 'file'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bank_mfo' => 'Банк МФО: ',
            'company_account' => 'Корхона хисоб рақами:',
            'company_inn' => 'Корхона ИНН: ',
            'file_name' => 'Юклаб олинган файллар:',
            'file_date' => 'Хисобот олинган сана: ',
            'data_period' => 'Оралиқ давр: ',
            'file' => 'Файл',
        ];
    }


    public function getCompanyName()
    {
        return $this->hasOne(Company::className(), ['inn' => 'company_inn']);
    }

}
