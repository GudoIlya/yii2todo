<?php

namespace app\modules\todo\migrations;

use app\modules\todo\models\task\Task;
use dektrium\user\models\User;
use yii\db\Expression;
use yii\db\Migration;

/**
 * Class M181020183248InitMigration
 */
class M181020183248InitMigration extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(Task::tableName(), [
            'id' => $this->primaryKey(),
            'task' => $this->string(300)->notNull(),
            'created_at' => $this->date()->notNull()->defaultValue(new Expression('now()')),
            'updated_at' => $this->date()->null()->defaultValue(null),
            'user_id' => $this->integer()->notNull(),
            'is_done' => $this->boolean()->defaultValue(false)
        ]);

        $this->addForeignKey('fk-task-user-id',
            Task::tableName(),
            'user_id',
            User::tableName(),
            'id',
            'CASCADE'
            );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-task-user-id', Task::tableName());
        $this->dropTable(Task::tableName());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M181020183248InitMigration cannot be reverted.\n";

        return false;
    }
    */
}
