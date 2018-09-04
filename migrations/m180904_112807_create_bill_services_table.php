<?php

use yii\db\Migration;

/**
 * Handles the creation of table `bill_services`.
 */
class m180904_112807_create_bill_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('bill_services', [
            'id' => $this->primaryKey(),
            'service_id' => $this->integer()->notNull(),
            'bill_id' => $this->integer()->notNull(),
            'rate_id' => $this->integer()->notNull(),
            'quantity' => $this->float()->notNull(),
            'summ' => $this->float()->notNull()
        ]);

        $this->addForeignKey(
            'fk-bill-services-service-id',
            'bill_services',
            'service_id',
            'services',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-bill-services-bill-id',
            'bill_services',
            'bill_id',
            'bills',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-bill-services-rate-id',
            'bill_services',
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
            'fk-bill-services-service-id',
            'bill_services'
        );

        $this->dropForeignKey(
            'fk-bill-services-bill-id',
            'bill_services'
        );

        $this->dropForeignKey(
            'fk-bill-services-rate-id',
            'bill_services'
        );

        $this->dropTable('bill_services');
    }
}
