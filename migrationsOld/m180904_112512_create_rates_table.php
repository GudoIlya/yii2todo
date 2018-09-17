<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rates`.
 */
class m180904_112512_create_rates_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('rates', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'price' => $this->float()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'date_create' => $this->date()->notNull()
        ]);

        $this->addForeignKey(
            'fk-rate-category-id',
            'rates',
            'category_id',
            'rate_categories',
            'id',
            'NO ACTION'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-rate-category-id',
            'rates'
        );

        $this->dropTable('rates');
    }
}
