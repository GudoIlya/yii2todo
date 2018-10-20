<?php
namespace app\modules\todo\DataProviders;

use yii\data\ActiveDataProvider;

class TodoDataProvider extends ActiveDataProvider
{

    /**
     * @return array|bool|ActiveRecord[]
     */
    public static function getUserTodos() {
        if( \Yii::$app->user->isGuest() ) {
            return false;
        }
        return self::find()
            ->innerJoin(User::tableName(), User::tableName().".id = ".self::tableName().".user_id")
            ->where(['user_id' => \Yii::$app->user->getId()])
            ->orderBy(['is_done' => 'DESC', 'created_at' => ASC])
            ->asArray()
            ->all();
    }

}