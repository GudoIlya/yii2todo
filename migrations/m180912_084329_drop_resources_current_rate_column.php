<?php

use yii\db\Migration;

/**
 * Class m180912_084329_drop_resources_current_rate_column
 */
class m180912_084329_drop_resources_current_rate_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-rates-resources-current-rate', 'resources');
        $this->dropColumn('resources', 'current_rate');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180912_084329_drop_resources_current_rate_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180912_084329_drop_resources_current_rate_column cannot be reverted.\n";

        return false;
    }
    */
}
