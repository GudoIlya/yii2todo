<?php
namespace app\modules\todo\models;

use yii\db\ActiveRecord;

class Project extends ActiveRecord
{
    public static function tableName() {
        return 'public.project';
    }


    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 300],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Идентифкатор',
            'name' => 'Наименование'
        ];
    }

}
