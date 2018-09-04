<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users_services`.
 */
class m180904_112658_create_users_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users_services', [
            'id' => $this->primaryKey(),
            'service_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'date_create' => $this->date()->notNull()
        ]);

        $this->addForeignKey(
            'fk-users-services-service-id',
            'users_services',
            'service_id',
            'services',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-users-services-user-id',
            'users_services',
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
            'fk-users-services-service-id',
            'users_services'
        );

        $this->dropForeignKey(
            'fk-users-services-user-id',
            'users_services'
        );

        $this->dropTable('users_services');
    }
}
