<?php
namespace app\modules\profile\models\bill;

use Yii;
use yii\base\Model;

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

    public $date_pay;

    public $services_summ;

    public $resources_summ;

    public $is_paid;

    public $billServices = [];

    public $billResources = [];

    /**
     * @return array
     */
   public function rules()
   {
       $rules = [
           [['billnumber', 'date_pay', 'estate_id', 'services_summ', 'resources_summ'], 'required'],
           [['billnumber'], 'string', 'max' => 100],
           [['estate_id'], 'integer'],
           [['date_pay'], 'safe'],
           [['is_paid'], 'boolean'],
           [['is_paid'], 'default', 'value' => false],
           [['total'], 'default', 'value' => null],
           [['total','services_summ','resources_summ'], 'number'],
           [['billnumber', 'estate_id'],'unique', 'targetAttribute' => ['billnumber', 'estate_id']],
           [['estate_id'],'exists','skipOnError'=>true, 'targetClass' => Estate::class, 'targetAttribute' => ['estate_id' => 'id']]
       ];
       return $rules;
   }


}