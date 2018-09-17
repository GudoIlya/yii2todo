<?php

use yii\db\Migration;

/**
 * Handles the creation of table `estate`.
 */
class m180917_121354_create_estate_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('estate', [
            'id' => $this->primaryKey(),
            'name' => $this->string(200)->notNull(),
            'description' => $this->string(500)->null(),
            'space' => $this->string(50)->notNull(),
            'user_id' => $this->integer()->notNull(),
            'user_portion' => $this->float()->notNull()->defaultValue(1)
        ]);

        $this->addForeignKey(
            'fk-estate-user-id',
            'estate',
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
        $this->dropForeignKey('fk-estate-user-id', 'estate');
        $this->dropTable('estate');
    }

}
