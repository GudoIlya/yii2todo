<?php

use yii\db\Migration;

/**
 * Handles the creation of table `estate`.
 */
class m180904_112510_create_estate_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('estate', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'space' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('estate');
    }
}
