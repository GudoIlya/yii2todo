<?php

use yii\db\Migration;

/**
 * Handles the creation of table `jkh_product`.
 */
class m180917_121331_create_jkh_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('jkh_product', [
            'id' => $this->primaryKey(),
            'name' => $this->string(200)->notNull(),
            'description' => $this->string(300)->null(),
            'product_type_id' => $this->integer()->notNull()
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('jkh_product');
    }
}
