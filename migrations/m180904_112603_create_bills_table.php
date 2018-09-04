<?php

use yii\db\Migration;

/**
 * Handles the creation of table `bills`.
 */
class m180904_112603_create_bills_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('bills', [
            'id' => $this->primaryKey(),
            'bill-number' => $this->string()->notNull()->unique(),
            'date' => $this->date()->notNull(),
            'services_summ' => $this->float()->notNull(),
            'resources_summ' => $this->float()->notNull(),
            'is_paid' => $this->boolean()->defaultValue(FALSE)
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('bills');
    }
}
