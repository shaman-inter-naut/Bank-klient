<?php

use yii\db\Migration;

/**
 * Class m200604_142135_contracts
 */
class m200604_142135_contracts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('contracts',[
            'id'=>$this->primaryKey(),
            'first_company'=>$this->string(),
            'second_company'=>$this->string(),
            'contract_number' => $this->string(),
            'contract_date' => $this->string(),
            'company_id' => $this->integer()

        ]);


        $this->addForeignKey(
            'contracts_to_company',
            'contracts',
            'company_id',
            'company',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200604_142135_contracts cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200604_142135_contracts cannot be reverted.\n";

        return false;
    }
    */
}
