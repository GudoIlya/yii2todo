<?php

use yii\db\Migration;

/**
 * Handles the creation of table `bill_resources`.
 */
class m180904_112802_create_bill_resources_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('bill_resources', [
            'id' => $this->primaryKey(),
            'resource_id' => $this->integer()->notNull(),
            'bill_id' => $this->integer()->notNull(),
            'rate_id' => $this->integer()->notNull(),
            'quantity' => $this->float()->notNull(),
            'summ' => $this->float()->notNull()
        ]);

        $this->addForeignKey(
            'fk-bill-resources-resource-id',
            'bill_resources',
            'resource_id',
            'resources',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-bill-resources-bill-id',
            'bill_resources',
            'bill_id',
            'bills',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-bill-resources-rate-id',
            'bill_resources',
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
        $this->dropForeignKey(
            'fk-bill-resources-resource-id',
            'bill_resources'
        );

        $this->dropForeignKey(
            'fk-bill-resources-bill-id',
            'bill_resources'
        );

        $this->dropForeignKey(
            'fk-bill-resources-rate-id',
            'bill_resources'
        );

        $this->dropTable('bill_resources');
    }
}
