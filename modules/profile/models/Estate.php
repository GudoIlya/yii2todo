<?php

namespace app\modules\profile\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use app\models\UserCustom;
use app\modules\profile\models\EstateProduct;
use app\modules\profile\models\Rates;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "estate".
 *
 * @property int $id
 * @property string $title
 * @property int $space
 *
 * @property EstateOwners[] $estateOwners
 */
class Estate extends ActiveRecord
{

    const CREATE_ESTATE = 'create';
    const UPDATE_ESTATE = 'update';

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::CREATE_ESTATE] = ['name', 'space', 'portion'];
        $scenarios[self::UPDATE_ESTATE] = ['name', 'space', 'portion'];
        return $scenarios;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => BlameableBehavior::className(),
            'createdByAttribute' => 'user_id',
            'updatedByAttribute' => false,
            'attributes' => [
                ActiveRecord::EVENT_BEFORE_VALIDATE => ['user_id']
            ]
        ];
        return $behaviors;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'space', 'user_portion'], 'required'],
            [['space'], 'default', 'value' => null],
            [['space'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
            [['name', 'user_id'], 'unique', 'targetAttribute' => ['name', 'user_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserCustom::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование недвижимости',
            'description' => 'Описание',
            'space' => 'Площадь',
            'user_portion' => 'Доля владения'
        ];
    }


    public function getEstateProducts($productType) {
        $query =  new Query();
        $query->select([
            'jp.*'
        ])
            ->from('jkh_product jp')
            ->innerJoin('estate_product ep', 'ep.product_id = jp.id and ep.estate_id = '.$this->id)
            ->where(['jp.type' => $productType]);

        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

    public function getEstateBills() {
        return true;
    }
}
