<?php

use yii\db\Migration;

/**
 * Class m200604_175754_bank_branch
 */
class m200604_175754_bank_branch extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('bank_branch',[
            'id'=>$this->primaryKey(),
            'name_branch'=>$this->string(),
            'mfo'=>$this->integer(),

            'bank_id'=>$this->integer()

        ]);


        $this->addForeignKey(
            'bank_branch_to_bank',
            'bank_branch',
            'bank_id',
            'bank',
            'id',
            'CASCADE'



        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200604_175754_bank_branch cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200604_175754_bank_branch cannot be reverted.\n";

        return false;
    }
    */
}
