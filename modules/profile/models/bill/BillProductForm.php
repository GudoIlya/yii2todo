<?php
namespace app\modules\profile\models\bill;

use app\modules\profile\models\BillProduct;
use app\modules\profile\models\EstateProduct;
use app\modules\profile\models\Jkhproduct;
use app\modules\profile\models\Rate;

use yii\base\Model;

class BillProductForm extends Model {

    /**
     * @var EstateProduct
     */
    public $estate_product;

    public $jkhProduct;

    public $rate;

    public $estate_product_id;

    public $rate_id;

    public $result;

    /**
     * @var BillProduct
     */
    public $billProduct;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->rate_id = $this->estate_product->rate_id;
        $this->estate_product_id = $this->estate_product->id;
        $this->billProduct = new BillProduct(['estate_product_id' => $this->estate_product_id, 'rate_id' => $this->rate_id]);
        $this->billProduct->getLastCounterValue();
        $this->rate = $this->estate_product->getRate()->one();
        $this->jkhProduct = $this->estate_product->getJkhProduct()->one();
        $this->result = $this->rate->price * $this->billProduct->quantity;
    }

    public function load($data, $formName = null)
    {
        $load = parent::load($data, $formName);
        $load = $this->billProduct->load($data, $formName) && $load;
        return $load;
    }
}