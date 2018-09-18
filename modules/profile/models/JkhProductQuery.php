<?php

namespace app\modules\profile\models;

use yii\db\ActiveQuery;

class JkhProductQuery extends ActiveQuery{

    public $type;
    public $table;

    public function prepare($builder) {
        if($this->type !== null) {
            $this->andWhere(["$this->tableName.type" => $this->type]);
        }
        return parent::prepare($builder);
    }

}