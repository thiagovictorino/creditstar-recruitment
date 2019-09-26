<?php
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
$this->title = 'Editing: ' . $model->first_name . ' ' . $model->last_name;
?>
<?= $this->render('_flash') ?>
<div class="user-update">
    <?= $this->render('_form', [
        'model' => $model,
        'action' => 'update'
    ]) ?>
</div>