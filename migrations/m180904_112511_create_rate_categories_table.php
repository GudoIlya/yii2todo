<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rate_categories`.
 */
class m180904_112511_create_rate_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('rate_categories', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('rate_categories');
    }
}
