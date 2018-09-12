<?php

use yii\db\Migration;

/**
 * Class m180912_075648_drop_rate_name_contraint
 */
class m180912_075648_drop_rate_name_contraint extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE rates DROP CONSTRAINT rate_name_key");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180912_075648_drop_rate_name_contraint cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180912_075648_drop_rate_name_contraint cannot be reverted.\n";

        return false;
    }
    */
}
