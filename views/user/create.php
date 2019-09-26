<?php

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */

$this->title = 'Addind new User';
?>
<div class="user-create">

    <?= $this->render('_form', [
        'model' => $model,
        'action' => 'create'
    ]) ?>

</div><!-- user-create -->