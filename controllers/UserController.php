<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserForm;
use yii\data\ActiveDataProvider;


class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = User::find();

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                    'first_name' => SORT_ASC,
                ]
            ],
        ]);
        return $this->render('index', ['userProvider' => $provider]);
    }

    public function actionView($id)
    {
        $object = User::find()->where([
            'id' => $id
        ])->one();

        if (empty($object)) {
            die('User cannot find');
        }

        return $this->render('view', ['user' => $object]);
    }

    public function actionCreate()
    {
        $model = new UserForm();
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $userModel = new User();
            $userModel->first_name = $model->first_name;
            $userModel->last_name = $model->last_name;
            $userModel->email = $model->email;
            $userModel->phone = $model->phone;
            $userModel->personal_code = $model->personal_code;
            $userModel->active = 1;
            $userModel->dead = 0;
            $userModel->lang = $model->lang;
            $userModel->save();
            Yii::$app->session->setFlash('success', "User has been created successfully!");
            return $this->redirect(['user/view', 'id' => $userModel->id]);

        }
            
        return $this->render('create', ['model' => $model]);
        
    }


    public function actionUpdate($id)
    {
        $model = new UserForm();
        $userModel = User::find()->where([
            'id' => $id
        ])->one();

        if (empty($userModel)) {
            die('User cannot find');
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $userModel->first_name = $model->first_name;
            $userModel->last_name = $model->last_name;
            $userModel->email = $model->email;
            $userModel->phone = $model->phone;
            $userModel->personal_code = $model->personal_code;
            $userModel->active = $model->active;
            $userModel->dead = $model->dead;
            $userModel->lang = $model->lang;
            $userModel->save();
            Yii::$app->session->setFlash('success', "User has been updated successfully!");
            return $this->redirect(['user/view', 'id' => $userModel->id]);
        } 

        $model->id = $userModel->id;
        $model->first_name = $userModel->first_name;
        $model->last_name = $userModel->last_name;
        $model->email = $userModel->email;
        $model->phone = $userModel->phone;
        $model->personal_code = $userModel->personal_code;
        $model->active = $userModel->active;
        $model->dead = $userModel->dead;
        $model->lang = $userModel->lang;
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
        $userModel = User::find()->where([
            'id' => $id
        ])->one();

        if (empty($userModel)) {
            die('User cannot find');
        }
        $userModel->delete();
        Yii::$app->session->setFlash('success', "User has been deleted successfully!");
        return $this->redirect('/user');
    }
}
