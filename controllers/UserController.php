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
            'id' => $id,
            'active' => 1
        ])->one();

        if (empty($object)) {
            die('User cannot find');
        }

        return $this->render('view', ['user' => $object]);
    }

    public function actionCreate()
    {
        $model = new UserForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $userModel = new User();
            $userModel->first_name = $model->first_name;
            $userModel->last_name = $model->last_name;
            $userModel->email = $model->email;
            $userModel->phone = $model->phone;
            $userModel->personal_code = $model->personal_code;
            $userModel->active = 1;
            $userModel->dead = ($model->dead == 'no') ? 1 : 0;
            $userModel->lang = $model->lang;
            if ($userModel->validate()) {
                $userModel->save();
                return $this->redirect(['users/view', 'id' => $userModel->id]);
            } else
                die(json_encode($userModel->errors));
        } else {
            return $this->render('create', ['model' => $model]);
        }
    }


    public function actionUpdate($id)
    {
        $model = new UserForm();
        $userModel = User::find()->where([
            'id' => $id,
            'active' => 1
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
            $userModel->active = 1;
            $userModel->dead = ($model->dead == 'no') ? 1 : 0;
            $userModel->lang = $model->lang;
            if ($userModel->validate()) {
                $userModel->save();
                return $this->redirect(['users/view', 'id' => $userModel->id]);
            } else
                die(json_encode($userModel->errors));
        } else {
            return $this->render('create', ['user' => $userModel, 'model' => $model]);
        }
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
            'id' => $id,
            'active' => 1
        ])->one();

        if (empty($userModel)) {
            die('User cannot find');
        }
        $userModel->delete();
        echo "User " . $id . " has been removed successfully";
        return;
    }
}
