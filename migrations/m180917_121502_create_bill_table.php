<?php
namespace app\migrations;
use yii\db\Migration;

/**
 * Handles the creation of table `bill`.
 */
class m180917_121502_create_bill_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('bill', [
            'id' => $this->primaryKey(),
            'billnumber' => $this->string(100)->notNull()->unique(),
            'total' => $this->float()->defaultValue(0),
            'estate_id' => $this->integer()->notNull(),
            'is_paid' => $this->boolean()->defaultValue(false),
            'date_pay' => $this->dateTime()->null(),
            'date_paid' => $this->dateTime()->null(),
            'date_create' => $this->dateTime()->notNull()
            ]);
        $this->addForeignKey(
            'fk-bill-estate-id',
            'bill',
            'estate_id',
            'estate',
            'id',
            'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-bill-estate-id', 'bill');
        $this->dropTable('bill');
    }
}
