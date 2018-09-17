<?php

use yii\db\Migration;

/**
 * Handles the creation of table `bill_product`.
 */
class m180917_121511_create_bill_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('bill_product', [
            'id' => $this->primaryKey(),
            'bill_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'rate_id' => $this->integer()->notNull(),
            'quantity' => $this->float()->notNull()
        ]);

        $this->addForeignKey(
            'fk-bill-product-bill-id',
            'bill_product',
            'bill_id',
            'bill',
            'id',
            'cascade'
        );
        $this->addForeignKey(
            'fk-bill-product-product-id',
            'bill_product',
            'product_id',
            'jkh_product',
            'id',
            'cascade'
        );

        $this->addForeignKey(
            'fk-bill-product-rate-id',
            'bill_product',
            'rate_id',
            'rate',
            'id',
            'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-bill-product-bill-id', 'bill_product');
        $this->dropForeignKey('fk-bill-product-product-id', 'bill_product');
        $this->dropForeignKey('fk-bill-product-rate-id', 'bill_product');
        $this->dropTable('bill_product');
    }
}
