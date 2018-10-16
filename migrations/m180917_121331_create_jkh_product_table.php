<?php
namespace app\migrations;

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
            'description' => $this->string(300)->null()->defaultValue(null),
            'standard_value' => $this->float()->null()->comment('Нормати'),
            'maintanence_end' => $this->date()->null()->comment('Окончание срока проверки - для счетчиков'),
            'type' => $this->string(100)->notNull(),
            'user_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk-jkh-product-user-id',
            'jkh_product',
            'user_id',
            'user',
            'id',
            'cascade'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-jkh-product-user-id', 'jkh_product');
        $this->dropTable('jkh_product');
    }
}
