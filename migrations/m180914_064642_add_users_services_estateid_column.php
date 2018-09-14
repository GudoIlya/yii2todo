<?php

use yii\db\Migration;

/**
 * Class m180914_064642_add_users_services_estateid_column
 */
class m180914_064642_add_users_services_estateid_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users_services', 'estate_id', 'integer NOT NULL');

        $this->addForeignKey(
          'fk-users-services-estate-id',
          'users_services',
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
        $this->dropForeignKey('fk-users-services-estate-id', 'users_services');
        $this->dropColumn('users_servies', 'estate_id');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180914_064642_add_users_services_estateid_column cannot be reverted.\n";

        return false;
    }
    */
}
