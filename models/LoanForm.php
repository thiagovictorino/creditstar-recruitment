<?php

namespace app\models;

use app\factories\PersonalCodeFactory;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoanForm extends Model
{
    public $id, $user_id, $amount, $interest, $duration, $start_date, $end_date, $campaign, $status;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['id','user_id', 'amount', 'interest', 'duration', 'start_date', 'end_date', 'campaign', 'status'], 'safe'],
            [['amount','interest','start_date','duration','campaign'], 'required'],
            [['amount','duration','interest'], 'integer'],
            [['start_date'], 'date', 'format' => 'php:d.m.Y', 'message'=>'Start date must be informed with DD.MM.YYYY format'],
            ['user_id', 'personalCodeValidation']
            
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['user_id', 'amount', 'interest', 'duration', 'start_date', 'end_date', 'campaign', 'status']; //Scenario Values Only Accepted
        return $scenarios;
    }

    public function personalCodeValidation($attribute, $params)
    {
        $user = User::find()->where([
            'id' => $this->$attribute
        ])->one();

        $dto = PersonalCodeFactory::make($user->personal_code);

        if (!$dto->is_allowed) {
            $this->addError($attribute, 'This user is underage');
        }
    }
}
