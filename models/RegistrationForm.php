<?php
namespace app\models;
use Yii;
class RegistrationForm extends \dektrium\user\models\RegistrationForm
{
 /**
  * @var string
  */
  public $telephone;

  /**
   * @inheritdoc
   */
  public function rules(){
      $rules = parent::rules();
      $rules['telephoneLength'] = ['telephone', 'string', 'max' => 11];
      return $rules;
  }

  public function attributeLabels()
  {
      $attributeLabels = parent::attributeLabels();
      $attributeLabels['telephone'] = Yii::t('user', 'Your phone');
      return $attributeLabels;
  }

}