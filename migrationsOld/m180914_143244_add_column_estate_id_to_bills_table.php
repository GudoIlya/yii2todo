<?php

use yii\db\Migration;

/**
 * Class m180914_143244_add_column_estate_id_to_bills_table
 */
class m180914_143244_add_column_estate_id_to_bills_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('bills', 'estate_id', 'integer NOT NULL');

        $this->addForeignKey(
            'fk-bills-estate-id',
            'bills',
            'estate_id',
            'estate',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-bills-estate-id', 'bills');
        $this->dropColumn('bills', 'estate_id');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180914_143244_add_column_estate_id_to_bills_table cannot be reverted.\n";

        return false;
    }
    */
}
