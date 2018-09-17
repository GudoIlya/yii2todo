<?php

use yii\db\Migration;

/**
 * Handles the creation of table `jkh_product_type`.
 */
class m180917_121311_create_jkh_product_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableName = "jkh_product_type";
        $this->createTable($tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull(),
            'description' => $this->string(300)->null()
        ]);

        $this->execute("
            INSERT INTO {$tableName} (name, description)
            VALUES ( 'Услуги', ''),
                   ( 'Ресурсы', '');
        ");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('jkh_product_type');
    }
}
