<?php

use yii\db\Migration;

/**
 * Class m200604_180233_files
 */
class m200604_180233_files extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('files',[
            'id'=>$this->primaryKey(),
            'company_inn'=>$this->integer(),
            'bank_mfo'=>$this->integer(),
            'company_account_number'=>$this->integer(),
            'file_date'=>$this->string(),
            'code_currency'=>$this->integer(),
            'period'=>$this->integer(),
            'first_sum'=>$this->integer(),
            'last_sum'=>$this->integer(),
            'debit'=>$this->integer(),
            'credit'=>$this->integer(),

            'account_number_id'=>$this->integer(),
            'currency_id'=>$this->integer()

        ]);


        $this->addForeignKey(
            'files_to_account_number',
            'files',
            'account_number_id',
            'account_number',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'files_to_currency',
            'files',
            'currency_id',
            'currency',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200604_180233_files cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200604_180233_files cannot be reverted.\n";

        return false;
    }
    */
}
