<?php

namespace app\modules\yandexapi;


use yii\base\BootstrapInterface;

/**
 * profile module definition class
 */
class Module extends \yii\base\Module
{

    public $token = '';

    public $url = 'https://yandex.api.ru';

    public $v = 'v2';


    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\yandexapi\controllers';


    /**
     * {@inheritdoc}
     */
    public function init()
    {
        if(\Yii::$app instanceof \yii\base\Application) {
            $this->controllerNamespace = 'app\modules\yandexapi\controllers';
        }
        parent::init();

        // custom initialization code goes here
    }

}
