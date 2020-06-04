<?php

use yii\db\Migration;

/**
 * Class m200604_180129_currency
 */
class m200604_180129_currency extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('currency',[
            'id'=>$this->primaryKey(),
            'name' => $this->string(),
            'code' => $this->integer(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200604_180129_currency cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200604_180129_currency cannot be reverted.\n";

        return false;
    }
    */
}
