<?php
namespace app\modules\todo\models\task;

use yii\db\ActiveRecord;

class TaskPriority extends ActiveRecord
{

    public static function tableName() {
        return 'public.task_priority';
    }


    public function rules()
    {
        return [
            [['name', 'color'], 'required'],
            [['name'], 'string', 'max' => 200],
            [['color'], 'string', 'max' => 7],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Идентифкатор',
            'name' => 'Приоритет',
            'color' => 'Цвет'
        ];
    }

}
