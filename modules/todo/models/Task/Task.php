<?php
namespace app\modules\todo\models\task;

use app\models\UserCustom as User;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;

class Task extends ActiveRecord
{
    /*
    * @property int $id
    * @property string $task
    * @property bool $is_done
     * @property int $user_id
    */

    public static function tableName() {
        return 'public.task';
    }

    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => false,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_VALIDATE => ['user_id']
                ]
            ]
        ];
    }

    public function rules()
    {
        return [
            [['task'], 'required'],
            [['task'], 'string', 'max' => 300],
            [['created_at', 'updated_at', 'is_done'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Идентифкатор',
            'task' => 'Задание',
            'is_done' => 'Закончено?',
            'user_id' => 'Идентификатор пользователя',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['user_id' => 'id']);
    }

}
