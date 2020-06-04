<?php

use yii\db\Migration;

/**
 * Class m200604_175836_account_number
 */
class m200604_175836_account_number extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('account_number',[
            'id'=>$this->primaryKey(),
            'account_number' => $this->integer(),
            'company_id' => $this->integer(),
            'bank_branch_id' => $this->integer(),

        ]);


        $this->addForeignKey(
            'account_number_to_company',
            'account_number',
            'company_id',
            'company',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'account_number_to_bank_branch',
            'account_number',
            'bank_branch_id',
            'bank_branch',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200604_175836_account_number cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200604_175836_account_number cannot be reverted.\n";

        return false;
    }
    */
}
