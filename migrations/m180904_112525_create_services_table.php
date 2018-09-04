<?php

use yii\db\Migration;

/**
 * Handles the creation of table `services`.
 */
class m180904_112525_create_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('services', [
            'id' => $this->primaryKey(),
            'current_rate' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->string()
        ]);

        $this->addForeignKey(
            'fk-rates-services-current-rate',
            'services',
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
        $this->dropForeignKey(
            'fk-rates-services-current-rate',
            'services'
        );

        $this->dropTable('services');
    }
}
