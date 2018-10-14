<?php
namespace app\migrations;
use yii\db\Migration;

/**
 * Handles the creation of table `estate_product`.
 */
class m180917_121444_create_estate_product_table extends Migration
{
    public $tableName = 'estate_product';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'estate_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'rate_id' => $this->integer()->notNull(),
            'default_value' => $this->string()->notNull()->defaultValue('0'),
            'date_create' => $this->dateTime()
        ]);

        $this->addForeignKey(
            'fk-estate-product-estate-id',
            $this->tableName,
            'estate_id',
            'estate',
            'id','cascade'
        );
        $this->addForeignKey(
            'fk-estate-product-product-id',
            $this->tableName,
            'product_id',
            'jkh_product',
            'id',
            'cascade'
        );
        $this->addForeignKey(
            'fk-estate-product-rate-id',
            $this->tableName,
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
        $this->dropForeignKey('fk-estate-product-estate-id', $this->tableName);
        $this->dropForeignKey('fk-estate-product-product-id', $this->tableName);
        $this->dropForeignKey('fk-estate-product-rate-id', $this->tableName);
        $this->dropTable('estate_product');
    }
}
