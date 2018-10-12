<?php
namespace app\modules\profile\models\bill;

use app\modules\profile\models\EstateProduct;
use app\modules\profile\models\Jkhproduct;
use app\modules\profile\models\Rate;

use yii\base\Model;

class BillProductForm extends Model {


    public $estate_product;

    public $rate;

    public $estate_product_id;

    public $quantity;

    public $current_counter_value;

    public $rate_id;

    public $result;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->rate = $this->getRate();
        $this->estate_product = $this->getEstateProduct();
        $this->result = $this->getRate()->price * $this->quantity;
    }

    public function getRate() {
        return Rate::find()->where(['id' => $this->rate_id])->one();
    }

    public function getEstateProduct() {
        return EstateProduct::find()
            ->where([EstateProduct::tableName().'.id' => $this->estate_product_id])->one();
    }
}