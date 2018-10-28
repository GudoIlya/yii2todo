<?php

namespace app\modules\todo\migrations;

use app\modules\todo\models\Project;
use app\modules\todo\models\task\Task;
use app\modules\todo\models\task\TaskPriority;
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
            'todo_time' => $this->date()->notNull()->defaultValue(new Expression('now()')),
            'created_at' => $this->date()->notNull()->defaultValue(new Expression('now()')),
            'updated_at' => $this->date()->null()->defaultValue(null),
            'user_id' => $this->integer()->notNull(),
            'is_done' => $this->boolean()->defaultValue(false),
            'priority_id' => $this->integer()->null(),
            'project_id' => $this->integer()->null()
        ]);

        $this->createTable(TaskPriority::tableName(), [
            'id' => $this->primaryKey(),
            'name' => $this->string(200)->notNull(),
            'color' => $this->string(7)->notNull(),
            'created_at' => $this->date()->notNull()->defaultValue(new Expression('now()')),
            'updated_at' => $this->date()->null()->defaultValue(null),
        ]);

        $this->insert(TaskPriority::tableName(), ['name' => 'Не важно', 'color' => '#fff']);
        $this->insert(TaskPriority::tableName(), ['name' => 'Важно', 'color' => '#ddd']);
        $this->insert(TaskPriority::tableName(), ['name' => 'Срочно', 'color' => '#ff0000']);

        $this->createTable(Project::tableName(), [
            'id' => $this->primaryKey(),
            'name' => $this->string(300)->notNull(),
            'created_at' => $this->date()->notNull()->defaultValue(new Expression('now()')),
            'updated_at' => $this->date()->null()->defaultValue(null),
        ]);

        $this->addForeignKey('fk-task-user-id',
            Task::tableName(),
            'user_id',
            User::tableName(),
            'id',
            'CASCADE'
            );

        $this->addForeignKey('fk-task-task-priority-id',
            Task::tableName(),
            'priority_id',
            TaskPriority::tableName(),
            'id',
            'CASCADE'
        );

        $this->addForeignKey('fk-task-project-id',
            Task::tableName(),
            'project_id',
            Project::tableName(),
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
        $this->dropForeignKey('fk-task-task-priority-id', Task::tableName());
        $this->dropForeignKey('fk-task-project-id', Task::tableName());
        $this->dropTable(Task::tableName());
        $this->dropTable(TaskPriority::tableName());
        $this->dropTable(Project::tableName());
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
