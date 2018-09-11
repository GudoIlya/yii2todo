<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users_rates`.
 */
class m180911_143800_create_users_rates_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users_rates', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'rate_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk-users-rates-user-id',
            'users_rates',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-users-rates-rate-id',
            'users_rates',
            'rate_id',
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
        $this->dropTable('users_rates');
    }
}
