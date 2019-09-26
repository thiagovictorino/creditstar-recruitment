<?php

use app\enums\PersonalCodeGenderEnum;
use app\factories\PersonalCodeFactory;

$this->title = 'Details: ' . $user->first_name . ' ' . $user->last_name;
$personalCode = PersonalCodeFactory::make($user->personal_code)
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
                    <?= $user->id ?>
                </div>
            </div>
            <div class="row">
                <div class='col-sm-3'>
                    Email:
                </div>
                <div class='col-sm-9'>
                    <?= $user->email ?>
                </div>
            </div>
            <div class="row">
                <div class='col-sm-3'>
                    Phone:
                </div>
                <div class='col-sm-9'>
                    <?= $user->phone ?>
                </div>
            </div>
            <div class="row">
                <div class='col-sm-3'>
                    Personal Code:
                </div>
                <div class='col-sm-9'>
                    <?= $user->personal_code ?>
                </div>
            </div>
            <div class="row">
                <div class='col-sm-3'>
                    Age:
                </div>
                <div class='col-sm-9'>
                    <?= $personalCode->age ?>
                </div>
            </div>
            <div class="row">
                <div class='col-sm-3'>
                    Birthday:
                </div>
                <div class='col-sm-9'>
                    <?= $personalCode->birthday->format('d.m.Y') ?>
                </div>
            </div>
            <div class="row">
                <div class='col-sm-3'>
                    Gender:
                </div>
                <div class='col-sm-9'>
                    <?= $personalCode->gender == PersonalCodeGenderEnum::MALE ? 'Male' : 'Female' ?>
                </div>
            </div>
            <div class="row">
                <div class='col-sm-3'>
                    Active:
                </div>
                <div class='col-sm-9'>
                    <?= $user->active ? 'Yes' : 'No' ?>
                </div>
            </div>
            <div class="row">
                <div class='col-sm-3'>
                    Dead:
                </div>
                <div class='col-sm-9'>
                    <?= $user->dead ? 'Yes' : 'No' ?>
                </div>
            </div>
            <div class="row">
                <div class='col-sm-3'>
                    Language:
                </div>
                <div class='col-sm-9'>
                    <?= $user->lang ?>
                </div>
            </div>
            <div class="row flex margin-top-large">
                <a href="<?= Yii::$app->url->toRoute('/user/update?id=' . $user->id) ?>"><button class="btn btn-warning button button-warning">Edit</button></a>&nbsp;
                <a href="<?= Yii::$app->url->toRoute('/user/delete?id=' . $user->id) ?>" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"><button class="btn btn-warning button button-danger margin-left-small">Delete</button></a>
            </div>
        </div>
    </div>
</div>