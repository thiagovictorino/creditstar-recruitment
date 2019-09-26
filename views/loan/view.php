<?php

use app\enums\PersonalCodeGenderEnum;
use app\factories\PersonalCodeFactory;

$this->title = 'Loan Details: <a href="'.Yii::$app->url->toRoute('/user/view?id='.$loan->user->id).'">' . $loan->user->first_name . ' ' . $loan->user->last_name.'</a>';
//$personalCode = PersonalCodeFactory::make($loan->personal_code)
?>
<div>
    <?= $this->render('_flash') ?>
    <div class='row'>
        <div class='col-sm-6'>
            <div class="row">
                <div class='col-sm-3'>
                    ID:
                </div>
                <div class='col-sm-9'>
                    <?= $loan->id ?>
                </div>
            </div>
            <div class="row">
                <div class='col-sm-3'>
                    Amount:
                </div>
                <div class='col-sm-9'>
                    € <?= $loan->amount ?>
                </div>
            </div>
            <div class="row">
                <div class='col-sm-3'>
                    Interest:
                </div>
                <div class='col-sm-9'>
                    <?= $loan->interest ?>%
                </div>
            </div>
            <div class="row">
                <div class='col-sm-3'>
                    Duration:
                </div>
                <div class='col-sm-9'>
                    <?= $loan->duration ?>
                </div>
            </div>
            <div class="row">
                <div class='col-sm-3'>
                    Start date:
                </div>
                <div class='col-sm-9'>
                    <?= (new DateTime($loan->start_date))->format('d.m.Y') ?>
                </div>
            </div>
            <div class="row">
                <div class='col-sm-3'>
                    End date:
                </div>
                <div class='col-sm-9'>
                    <?= (new DateTime($loan->end_date))->format('d.m.Y') ?>
                </div>
            </div>
            <div class="row">
                <div class='col-sm-3'>
                    Campaign:
                </div>
                <div class='col-sm-9'>
                    <?= $loan->campaign ?>
                </div>
            </div>
            <div class="row">
                <div class='col-sm-3'>
                    Status:
                </div>
                <div class='col-sm-9'>
                    <?= $loan->status ?>
                </div>
            </div>

            <div class="row flex margin-top-large">
                <a href="<?= Yii::$app->url->toRoute('/loan/update?id=' . $loan->id) ?>"><button class="btn btn-warning button button-warning">Edit</button></a>&nbsp;
                <a href="<?= Yii::$app->url->toRoute('/loan/delete?id=' . $loan->id) ?>" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"><button class="btn btn-warning button button-danger margin-left-small">Delete</button></a>
            </div>
        </div>
    </div>
</div>