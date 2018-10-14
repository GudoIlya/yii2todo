<?php

namespace app\modules\catalog\migrations;

use app\modules\catalog\models\Category;
use yii\db\Migration;

/**
 * Class M180929065724CreateCatagoryTable
 */
class M180929065724CreateCatagoryTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(Category::tableName(),[
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text()->null()->defaultValue(null),
            'active' => $this->boolean()->defaultValue(true),
            'created_at' => $this->date()->null()->defaultValue(null),
            'updated_at' => $this->date()->null()->defaultValue(null)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "M180929065724CreateCatagoryTable cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M180929065724CreateCatagoryTable cannot be reverted.\n";

        return false;
    }
    */
}
