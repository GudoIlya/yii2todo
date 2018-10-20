<?php
namespace app\modules\todo\models\task;

use app\models\UserCustom as User;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;

class Task extends ActiveRecord
{
    /**
     * @var string
     */
    public $task;

    /**
     * @var bool
     */
    public $is_done;

    /**
     * @var integer
     */
    public $user_id;

    /**
     * @var date
     */
    public $created_at;

    /**
     * @var
     */
    public $updated_at;

    public static function tableName() {
        return 'public.task';
    }

    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => false,
                'attribute' => [
                    ActiveRecord::EVENT_BEFORE_VALIDATE => ['user_id']
                ]
            ]
        ];
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 150],
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'exists', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']]
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
