<?php

namespace app\modules\profile\models;

use app\modules\profile\models\JkhProductQuery;
use app\modules\profile\models\Jkhproduct;

class JkhService extends Jkhproduct {

    const TYPE = 'service';
    const TYPE_NAME = 'Услуга';

    public function init() {
        $this->type = self::TYPE;
        parent::init();
    }

    public static function find() {
        return new JkhProductQuery(get_called_class(), ['type' => self::TYPE, 'tableName' => self::tableName()]);
    }

    public function beforeSave($insert) {
        $this->type = self::TYPE;
        return parent::beforeSave($insert);
    }


    public function getRates() {
        return self::find()->innerJoin('rate', 'id = rate.id');
    }
}