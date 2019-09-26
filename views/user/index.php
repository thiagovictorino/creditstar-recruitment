<?php
/* @var $this yii\web\View */

use app\factories\PersonalCodeFactory;

$this->title = 'Users';

$columns = [
    [
        'attribute' => 'id',
        'format' => 'text'
    ],
    [
        'attribute' => 'first_name',
        'format' => 'text'
    ],
    [
        'attribute' => 'last_name',
        'format' => 'text'
    ],
    [
        'attribute' => 'email',
        'format' => 'text'
    ],
    [
        'attribute' => 'personal_code',
        'format' => 'text'
    ],
    [
        'attribute' => 'age',
        'value' => function ($model) {
            return PersonalCodeFactory::make($model->personal_code)->age;
        }
    ],
    [
        'attribute' => 'active',
        'value' => function ($model) {

            return $model->active == 1 ? 'Yes' : 'No';
        }
    ],
    [
        'attribute' => 'dead',
        'value' => function ($model) {

            return $model->dead == 1 ? 'Yes' : 'No';
        }
    ],
    [
        'attribute' => 'lang',
        'format' => 'text'
    ],
];
$columns[] = ['class' => 'yii\grid\ActionColumn'];
?>

<?= $this->render('_flash')?>

<div class='row'>
    <div class="col-sm-10"></div>
    <div class="col-sm-2"><a href='<?= Yii::$app->url->toRoute('/user/create') ?>'><button class="btn btn-warning button button-warning">Add new user</button></a></div>
</div>
<div class='w-full overflow-x-auto'>
    <?php
    echo yii\grid\GridView::widget([
        'tableOptions' => [
            'id' => 'theDatatable',
            'class' => 'table app-table'
        ],
        'pager' => [
            'pageCssClass' => 'app-page',
            'prevPageCssClass' => 'app-page',
            'nextPageCssClass' => 'app-page'
        ],
        'dataProvider' => $userProvider,
        'columns' => $columns,
    ]);
    ?>
    <div>