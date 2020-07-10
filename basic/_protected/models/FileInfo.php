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
            [['file', 'bank_id'], 'required'],
            [['bank_mfo'], 'string', 'max' => 10],
            [['company_account', 'data_period'], 'string', 'max' => 50],
            [['company_inn', 'file_date'], 'string', 'max' => 25],
            [['file_name'], 'string', 'max' => 255],
            [['template'], 'string', 'max' => 5],
            [['depozitAfter', 'depozitBefore'], 'string', 'max' => 75],
            [['file'], 'file'],
            [['description'], 'integer'],
            [['countDetailToRecord'], 'integer'],
            [['countDetailNoRecord'], 'integer'],
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
            'file_name' => 'Юклаб олинган файл:',
            'file_date' => 'Хисобот олинган сана: ',
            'data_period_start' => 'Оралиқ давр бошланиш санаси: ',
            'data_period_end' => 'Оралиқ давр якуний санаси: ',
            'file' => 'Файл',
            'bank_id' => 'Банк ID',
            'template' => '',
            'name' => 'Корхона номи:',
            'depozitBefore' => 'Бошланғич депозит:',
            'depozitAfter' => 'Якуний депозит:',
            'description' => 'Изох (Проводкалар):',
            'countDetailToRecord' => 'Жами проводкалар сони:',
            'countDetailNoRecord' => 'Сақланмаган проводкалар (аввал сақланган)',
        ];
    }

//    public function beforeSave($insert)
//    {
//        if ($insert) {
//
//            ($this->detail_debet == 0) ? $this->tip_deb_kred = 0 : $this->tip_deb_kred = 1;
//
//            return parent::beforeSave($insert);
//        }
//    }



    public function getCompanyName()
    {
        return $this->hasOne(Company::className(), ['inn' => 'company_inn']);
    }
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['inn' => 'company_inn']);
    }

    public function getDoc()
    {
        return $this->hasOne(Document::className(), ['file_id' => 'id']);
    }
    public function getDocument()
    {
        return $this->hasMany(Document::className(), ['file_id' => 'id']);
    }
    public function getDocuments()
    {
        return $this->hasMany(Documents::className(), ['file_id' => 'id']);
    }

}
