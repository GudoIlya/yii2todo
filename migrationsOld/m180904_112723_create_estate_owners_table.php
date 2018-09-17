<?php

use yii\db\Migration;

/**
 * Handles the creation of table `estate_owners`.
 */
class m180904_112723_create_estate_owners_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('estate_owners', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'estate_id' => $this->integer()->notNull(),
            'portion' => $this->float()->notNull()
        ]);

        $this->addForeignKey(
            'fk-estate-owners-user-id',
            'estate_owners',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-estate-owners-estate-id',
            'estate_owners',
            'estate_id',
            'estate',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-estate-owners-user-id',
            'estate_owners'
        );

        $this->dropForeignKey(
            'fk-estate-owners-estate-id',
            'estate_owners'
        );

        $this->dropTable('estate_owners');
    }
}
