<?php

use yii\db\Migration;

/**
 * Class m200604_141831_company
 */
class m200604_141831_company extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('company',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(),
            'inn'=> $this->integer(),
            'unical_code' => $this->integer()

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200604_141831_company cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200604_141831_company cannot be reverted.\n";

        return false;
    }
    */
}
