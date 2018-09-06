<?php

use yii\db\Migration;

/**
 * Class m180906_134615_delete_field_from_table
 */
class m180906_134615_delete_field_from_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('estate_owners', 'portion');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180906_134615_delete_field_from_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180906_134615_delete_field_from_table cannot be reverted.\n";

        return false;
    }
    */
}
