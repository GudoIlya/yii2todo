<?php

use yii\db\Migration;

/**
 * Class m180914_064651_add_users_resources_estateid_column
 */
class m180914_064651_add_users_resources_estateid_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users_resources', 'estate_id', 'integer NOT NULL');

        $this->addForeignKey(
            'fk-users-resources-estate-id',
            'users_resources',
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
        $this->dropForeignKey('fk-users-resources-estate-id', 'users_resources');
        $this->dropColumn('users_resources','estate_id');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180914_064651_add_users_resources_estateid_column cannot be reverted.\n";

        return false;
    }
    */
}
