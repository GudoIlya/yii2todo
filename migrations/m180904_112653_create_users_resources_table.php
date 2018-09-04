<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users_resources`.
 */
class m180904_112653_create_users_resources_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users_resources', [
            'id' => $this->primaryKey(),
            'resource_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'date_create' => $this->date()->notNull()
        ]);

        $this->addForeignKey(
          'fk-users-resources-resource-id',
          'users_resources',
          'resource_id',
          'resources',
          'id',
          'CASCADE'
        );

        $this->addForeignKey(
            'fk-users-user-user-id',
            'users_resources',
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
        $this->dropForeignKey(
            'fk-users-resources-resource-id',
            'users_resources'
        );

        $this->dropForeignKey(
            'fk-users-user-user-id',
            'users_resources'
        );

        $this->dropTable('users_resources');
    }
}
