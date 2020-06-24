<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expence_types".
 *
 * @property int $id
 * @property string $name
 */
class ExpenceTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expence_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['name'], 'required'],
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
}
