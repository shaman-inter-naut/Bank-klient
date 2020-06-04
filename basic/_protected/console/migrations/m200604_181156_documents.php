<?php

use yii\db\Migration;

/**
 * Class m200604_181156_documents
 */
class m200604_181156_documents extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('documents',[
            'id'=>$this->primaryKey(),
            'inn_company'=>$this->integer(),
            'mfo_bank'=>$this->integer(),
            'account_number_company'=>$this->integer(),

            'date'=>$this->string(),
            'document_number'=>$this->string(),
            'mfo_branch'=>$this->integer(),
            'inn_branch'=>$this->integer(),
            'name_branch'=>$this->string(),
            'account_number_branch'=>$this->integer(),
            'purpose_branch'=>$this->string(),
            'code_currency'=>$this->integer(),
            'kirim'=>$this->integer(),
            'chiqim'=>$this->integer(),
            'tip_k_ch'=>$this->integer(),
            'contract_date'=>$this->string(),
            'contract_number'=>$this->integer(),

            'contracts_id'=>$this->integer(),
            'currency_id'=>$this->integer(),
            'account_number_id'=>$this->integer(),
            'bank_branch_id'=>$this->integer(),

        ]);


        $this->addForeignKey(
            'documents_to_account_number',
            'documents',
            'account_number_id',
            'account_number',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'documents_to_currency',
            'documents',
            'currency_id',
            'currency',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'documents_to_contracts',
            'documents',
            'contracts_id',
            'contracts',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'documents_to_bank_branch',
            'documents',
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
        echo "m200604_181156_documents cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200604_181156_documents cannot be reverted.\n";

        return false;
    }
    */
}
