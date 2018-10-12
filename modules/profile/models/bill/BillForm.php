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
     * @property BillResources[] $billResources
     * @property BillServices[] $billServices
     */

    public $billnumber;

    public $estate_id;

    public $date_pay;

    public $date_create;

    public $date_paid;

    public $total;

    public $is_paid;

    public $services = [];

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
           [['billnumber', 'date_pay', 'estate_id', 'services_summ', 'resources_summ'], 'required'],
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
       $this->setProducts();
   }

   public function setProducts() {
       $services = Estate::getEstateProductsByEstateId($this->estate_id, JkhService::TYPE);
       foreach ($services as $service) {
           $this->services[] = new BillProductForm([
               'estate_product_id' => $service->id,
               'rate_id' => $service->rate_id
           ]);
       }
       $resources = Estate::getEstateProductsByEstateId($this->estate_id, JkhResource::TYPE);;
        foreach ($resources as $resource) {
            $this->resources[] = new BillProductForm([
                'estate_product_id' => $resource->id,
                'rate_id' => $resource->rate_id
            ]);
        }
   }

   public function save() {
       if(Yii::$app->request->isPost) {
           $bill = new Bill();
           $transaction = Yii::$app->db->beginTransaction(
               Transaction::SERIALIZABLE
           );
           $bill->load(Yii::$app->request->post());
           try {
               $valid = $bill->validate();
               if ($valid) {
                   $bill->save(false);
                   $billProducts = array_merge($this->services, $this->resources);
                   foreach ($billProducts as $i => $billProduct) {
                       $billProducts[$i]->bill_id = $bill->id;
                   }
                   $valid = Model::validateMultiple($billProducts);
                   if ($valid) {
                       foreach ($billProducts as $billProductForm) {
                           $billProductObject = new BillProduct($billProductForm);
                           $billProductObject->save();
                       }
                       $transaction->commit();
                       return $this->redirect(['/profile/bill/view', 'id' => $bill->id]);
                   } else {
                       $transaction->rollBack();
                       return false;
                   }
               }
           } catch (\Exception $e) {
               $transaction->rollBack();
               throw new BadRequestHttpException($e->getMessage(), 0, $e);
           }
       }
       return false;
   }

}