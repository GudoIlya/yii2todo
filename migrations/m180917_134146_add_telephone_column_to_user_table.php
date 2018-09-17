<?php

use yii\db\Migration;

/**
 * Handles adding telephone to table `user`.
 */
class m180917_134146_add_telephone_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'telephone', $this->string(11)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
