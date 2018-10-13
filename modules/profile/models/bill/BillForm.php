<?php
namespace app\modules\profile\models\bill;

use app\modules\profile\models\Bill;
use app\modules\profile\models\BillProduct;
use app\modules\profile\models\Estate;
use app\modules\profile\models\JkhResource;
use app\modules\profile\models\JkhService;
use Yii;
use yii\base\Model;
use yii\behaviors\BlameableBehavior;
use yii\db\Transaction;

class BillForm extends Model {

    /**
     * Тут должен быть
     * @property int $id
     * @property string $billnumber
     * @property string $date
     * @property double $services_summ
     * @property double $resources_summ
     * @property bool $is_paid
     *
     * @property $services[] BillProduct
     * @property $resources[] BillProduct
     */

    /**
     * @var integer
     */
    public $estate_id;

    /**
     * @var Bill
     */
    public $bill;

    /**
     * @var BillProductForm
     */
    public $services = [];

    /**
     * @var BillProduct
     */
    public $resources = [];

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => BlameableBehavior::class,
            'createByAttribute' => 'date_create'
        ];
        return parent::behaviors();
    }

    /**
     * @return array
     */
   public function rules()
   {
       $rules = [
           [['billnumber', 'date_pay', 'estate_id'], 'required'],
           [['billnumber'], 'string', 'max' => 100],
           [['estate_id'], 'integer'],
           [['date_pay', 'date_paid', 'date_create'], 'safe'],
           [['is_paid'], 'boolean'],
           [['is_paid'], 'default', 'value' => false],
           [['total'], 'default', 'value' => null],
           [['total','services_summ','resources_summ'], 'number'],
           [['billnumber', 'estate_id'],'unique', 'targetAttribute' => ['billnumber', 'estate_id']],
           [['estate_id'],'exist','skipOnError'=>true, 'targetClass' => Estate::class, 'targetAttribute' => ['estate_id' => 'id']]
       ];
       return $rules;
   }

   public function __construct(array $config = [])
   {
       parent::__construct($config);
       $this->bill = new Bill(['estate_id' => $this->estate_id]);
       $this->setProducts();
   }

   public function setProducts() {
       $services = Estate::getEstateProductsByEstateId($this->estate_id, JkhService::TYPE);
       foreach ($services as $service) {
           $this->services[] = new BillProductForm([
               'estate_product' => $service
           ]);
       }
       $resources = Estate::getEstateProductsByEstateId($this->estate_id, JkhResource::TYPE);;
        foreach ($resources as $resource) {
            $this->resources[] = new BillProductForm([
                'estate_product' => $resource
            ]);
        }
   }

   public function save() {
           $transaction = Yii::$app->db->beginTransaction(
               Transaction::SERIALIZABLE
           );
           try {
               $this->bill->validate();
               if ($this->bill->save()) {
                   $billProducts = [];
                   foreach (array_merge($this->services, $this->resources) as $i => $productFormItem) {
                       $productFormItem->billProduct->bill_id = $this->bill->id;
                       $billProducts[$i] = $productFormItem->billProduct;
                   }
                   $valid = Model::validateMultiple($billProducts);
                   if ($valid) {
                       foreach ($billProducts as $billProduct) {
                           $billProduct->save();
                       }
                       $transaction->commit();
                       return $this->redirect(['/profile/bill/view', 'id' => $this->bill->id]);
                   } else {
                       $transaction->rollBack();
                       return false;
                   }
               }
           } catch (\Exception $e) {
               $transaction->rollBack();
               throw new BadRequestHttpException($e->getMessage(), 0, $e);
           }
       return false;
   }

   public function load($data, $formName = null)
   {
       $load = parent::load($data, $formName);
       $load = $this->bill->load($data, $formName) && $load;
       $load = Model::loadMultiple(array_merge($this->services, $this->resources), $data['BillProductForm']);
       $load = Model::loadMultiple($this->services, $data['BillProduct'], 'services') && $load;
       $load = Model::loadMultiple($this->resources, $data['BillProduct'], 'resources') && $load;
       return $load;
   }


}