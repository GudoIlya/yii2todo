<?php

use yii\db\Migration;

/**
 * Class m180904_090831_add_new_field_to_user
 */
class m180904_090831_add_new_field_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'telephone', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'telephone');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180904_090831_add_new_field_to_user cannot be reverted.\n";

        return false;
    }
    */
}
