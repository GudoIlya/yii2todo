<?php

use yii\db\Migration;

/**
 * Handles the creation of table `resources`.
 */
class m180904_112536_create_resources_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('resources', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(),
            'current_rate' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk-rates-resources-current-rate',
            'resources',
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
            'fk-rates-resources-current-rate',
            'resources'
        );

        $this->dropTable('resources');
    }
}
