<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rate`.
 */
class m180917_121422_create_rate_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('rate', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull(),
            'price' => $this->float()->notNull(),
            'date_create' => $this->dateTime()->notNull(),
            'unit' => $this->string(100),
            'product_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
          'fk-rate-product-id',
          'rate',
          'product_id',
          'jkh_product',
          'id',
          'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-rate-product-id', 'rate');
        $this->dropTable('rate');
    }
}
