<?php

use yii\db\Migration;

/**
 * Class m180912_071757_add_column_to_rates_table
 */
class m180912_071757_add_column_to_rates_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('rates', 'user_id', 'integer NOT NULL');
        $this->addForeignKey(
            'fk-rates-users-user-id',
            'rates',
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
        $this->dropColumn('rates', 'user_id');
        $this->dropForeignKey('fk-rates-users-user-id');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180912_071757_add_column_to_rates_table cannot be reverted.\n";

        return false;
    }
    */
}
