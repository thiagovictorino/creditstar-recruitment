<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?=$form->field($model, 'id')->hiddenInput()->label(false)?>
    
    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'personal_code') ?>

    <?= $form->field($model, 'phone') ?>

    <?php 
        if($action == 'create'){
            echo $form->field($model, 'active')->hiddenInput()->label(false);
            echo $form->field($model, 'dead')->hiddenInput()->label(false);
        }else{
            echo $form->field($model, 'active')->checkbox();
            echo $form->field($model, 'dead')->checkbox();
        }
        
    ?>

    <?= $form->field($model, 'lang')->dropDownList(
        [
            'est' => 'Estonian',
            'rus' => 'Russian',
        ]
        );
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-warning button button-warning']) ?>
    </div>

    <?php $form = ActiveForm::end(); ?>

</div>