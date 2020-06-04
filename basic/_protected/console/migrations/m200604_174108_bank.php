<?php

use yii\db\Migration;

/**
 * Class m200604_174108_bank
 */
class m200604_174108_bank extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('bank',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string()

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200604_174108_bank cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200604_174108_bank cannot be reverted.\n";

        return false;
    }
    */
}
