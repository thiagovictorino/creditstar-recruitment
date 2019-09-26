<?php

namespace app\models;

use app\exceptions\PersonalCodeException;
use app\factories\PersonalCodeFactory;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class UserForm extends Model
{
    public $id, $active, $dead, $first_name,$last_name,$phone,$email,$personal_code,$lang;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name','email','phone','personal_code','lang'], 'required'],
            ['active', 'safe'],
            ['dead', 'safe'],
            ['phone','integer'],
            ['email', 'email'],
            ['email', 'unique', 'on' => 'create', 'targetClass' => '\app\models\User', 'message' => 'This e-mail is already registered.'],
            ['personal_code','personalCodeValidation'],
            ['personal_code', 'unique', 'on' => 'create', 'targetClass' => '\app\models\User', 'message' => 'This Personal Code is already registered.'],
            ['lang','string']
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['first_name', 'last_name', 'email', 'phone', 'personal_code', 'lang']; //Scenario Values Only Accepted
        return $scenarios;
    }

    public function personalCodeValidation($attribute, $params)
    {
        try{
            PersonalCodeFactory::make($this->$attribute);
            return true;
        }catch(PersonalCodeException $e){
            $this->addError($attribute, 'Invalid Personal Code');
        }
            
    }
}
