<?php

use yii\db\Migration;

/**
 * Class m180914_142734_add_columnd_to_bills_table
 */
class m180914_142734_add_columnd_to_bills_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('bills', 'user_id', 'integer NOT NULL');

        $this->addForeignKey(
            'fk-bills-user-id',
            'bills',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-bills-user-id', 'bills');
        $this->dropColumn('bills', 'user_id');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180914_142734_add_columnd_to_bills_table cannot be reverted.\n";

        return false;
    }
    */
}
