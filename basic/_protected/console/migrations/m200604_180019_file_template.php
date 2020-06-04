<?php

use yii\db\Migration;

/**
 * Class m200604_180019_file_template
 */
class m200604_180019_file_template extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('file_template',[
            'id'=>$this->primaryKey(),
            'bank_id' => $this->integer(),
            'in_address' => $this->string(),
            'mfo_address' => $this->string(),
            'x/r_address' => $this->string(),
            'date_address' => $this->string(),
            'file_number_address' => $this->string(),

        ]);


        $this->addForeignKey(
            'file_template_to_bank',
            'file_template',
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
        echo "m200604_180019_file_template cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200604_180019_file_template cannot be reverted.\n";

        return false;
    }
    */
}
