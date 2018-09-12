<?php

use yii\db\Migration;

/**
 * Class m180912_084400_add_users_services_current_rate_column
 */
class m180912_084400_add_users_services_current_rate_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('users_services', 'current_rate', 'integer NOT NULL');

        $this->addForeignKey(
            'fk-users-services-rate-id',
            'users_services',
            'current_rate',
            'rates',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180912_084400_add_users_services_current_rate_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180912_084400_add_users_services_current_rate_column cannot be reverted.\n";

        return false;
    }
    */
}
