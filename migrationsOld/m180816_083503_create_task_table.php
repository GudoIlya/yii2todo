<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task`.
 */
class m180816_083503_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'start_date'  => $this->datetime()->notNull(),
            'end_date'    => $this->datetime()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('task');
    }
}
