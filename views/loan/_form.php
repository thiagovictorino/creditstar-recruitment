<?php

use app\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?=$form->field($model, 'id')->hiddenInput()->label(false)?>
    
    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'interest') ?>

    <?= $form->field($model, 'start_date') ?>

    <?= $form->field($model, 'duration') ?>

    <?= $form->field($model, 'campaign') ?>

    <?php

        $data = [];
        $users = User::find()->orderBy('first_name')->all();
        foreach ($users as $user) {
            $data[$user->id] = $user->first_name .' '.$user->last_name;
        }
    
        echo $form->field($model, 'user_id')->label('Users')->dropDownList($data);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-warning button button-warning']) ?>
    </div>

    <?php $form = ActiveForm::end(); ?>

</div>