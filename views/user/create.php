<?php
/* @var $this yii\web\View */
if(isset($user))
    $this->title = 'Users | Update :'.$user->id;
else
    $this->title = 'Users | Create';
?>
<h1><?=$this->title?></h1>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'options' => ['class' => 'form-group'],
]) ?>
<?= $form->field($model, 'first_name',['labelOptions' => [ 'class' => 'form-label' ]])->textInput(['class'=>'form-input','value'=>@$user->first_name]) ?>
<?= $form->field($model, 'last_name',['labelOptions' => [ 'class' => 'form-label' ]])->textInput(['class'=>'form-input','value'=>@$user->last_name]) ?>
<?= $form->field($model, 'email',['labelOptions' => [ 'class' => 'form-label' ]])->textInput(['class'=>'form-input','value'=>@$user->email]) ?>
<?= $form->field($model, 'phone',['labelOptions' => [ 'class' => 'form-label' ]])->textInput(['class'=>'form-input','value'=>@$user->phone]) ?>
<?= $form->field($model, 'personal_code',['labelOptions' => [ 'class' => 'form-label' ]])->textInput(['class'=>'form-input','value'=>@$user->personal_code]) ?>
<?= $form->field($model, 'dead',['labelOptions' => [ 'class' => 'form-label' ]])->textInput(['class'=>'form-input','value'=>@$user->dead]) ?>
<?= $form->field($model, 'lang',['labelOptions' => [ 'class' => 'form-label' ]])->textInput(['class'=>'form-input','value'=>@$user->lang]) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?php if(isset($user)): ?>
                <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
            <?php else: ?>
                <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
            <?php endif; ?>
        </div>
    </div>
<?php ActiveForm::end() ?>