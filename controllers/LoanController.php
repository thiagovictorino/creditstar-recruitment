<?php

namespace app\controllers;

use Yii;
use app\models\Loan;
use app\models\LoanForm;
use app\models\UserForm;
use DateTime;
use yii\data\ActiveDataProvider;


class LoanController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = Loan::find()->with('user');

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);
        return $this->render('index', ['loanProvider' => $provider]);
    }

    public function actionView($id)
    {
        $object = Loan::find()->where([
            'id' => $id
        ])->one();

        if (empty($object)) {
            die('User cannot find');
        }

        return $this->render('view', ['loan' => $object]);
    }

    public function actionCreate()
    {
        $model = new LoanForm();
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $loanModel = new Loan();
            $loanModel->user_id = $model->user_id;
            $loanModel->amount = $model->amount;
            $loanModel->interest = $model->interest;
            $loanModel->duration = $model->duration;
            $date = new DateTime($model->start_date);
            $loanModel->start_date = $date->format('Y-m-d');
            $date->modify('+'.$model->duration.' month');
            $loanModel->end_date = $date->format('Y-m-d');
            $loanModel->campaign = 1;
            $loanModel->status = 0;
            $loanModel->save();
            Yii::$app->session->setFlash('success', "Loan has been created successfully!");
            return $this->redirect(['loan/view', 'id' => $loanModel->id]);

        }
            
        return $this->render('create', ['model' => $model]);
        
    }


    public function actionUpdate($id)
    {
        $model = new LoanForm();
        $loanModel = Loan::find()->where([
            'id' => $id
        ])->one();

        if (empty($loanModel)) {
            die('User cannot find');
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $loanModel->user_id = $model->user_id;
            $loanModel->amount = $model->amount;
            $loanModel->interest = $model->interest;
            $loanModel->duration = $model->duration;
            $date = new DateTime($model->start_date);
            $loanModel->start_date = $date->format('Y-m-d');
            $date->modify('+'.$model->duration.' month');
            $loanModel->end_date = $date->format('Y-m-d');
            $loanModel->campaign = 1;
            $loanModel->status = 0;
            $loanModel->save();
            Yii::$app->session->setFlash('success', "Loan has been updated successfully!");
            return $this->redirect(['loan/view', 'id' => $loanModel->id]);
        } 

        $model->id = $loanModel->id;
        $model->user_id = $loanModel->user_id;
        $model->amount = round($loanModel->amount);
        $model->interest = round($loanModel->interest);
        $model->duration = $loanModel->duration;
        $date = new DateTime($loanModel->start_date);
        $model->start_date = $date->format('d.m.Y');
        $model->campaign = $loanModel->campaign;
        $model->status = $loanModel->status;
        return $this->render('update', ['model' => $model]);
    }

    /**
     * @param $id
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $loanModel = Loan::find()->where([
            'id' => $id
        ])->one();

        if (empty($loanModel)) {
            die('User cannot find');
        }
        $loanModel->delete();
        Yii::$app->session->setFlash('success', "Loan has been deleted successfully!");
        return $this->redirect('/loan');
    }
}
