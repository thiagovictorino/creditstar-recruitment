<?php
/* @var $this yii\web\View */

use app\factories\PersonalCodeFactory;

$this->title = 'Loans';

$columns = [
    [
        'attribute' => 'id',
        'format' => 'text'
    ],
    [

        'attribute' => 'user_id',

        'label' => 'User',

        'value' => function ($model) {

            return $model->user->first_name.' '.$model->user->last_name;
        }

    ],
    [
        'attribute' => 'amount',
        'value' => function ($model) {

            return '€ '.$model->amount;
        }
    ],
    [
        'attribute' => 'interest',
        'value' => function ($model) {

            return $model->interest.'%';
        }
    ],
    [
        'attribute' => 'start_date',
        'format' => 'text',
        'value' => function ($model) {

            return (new DateTime($model->start_date))->format('d.m.Y') ;
        }
    ],
    [
        'attribute' => 'end_date',
        'format' => 'text',
        'value' => function ($model) {

            return (new DateTime($model->end_date))->format('d.m.Y');
        }
    ],
    [
        'attribute' => 'duration',
        'format' => 'text'
    ],
    [
        'attribute' => 'status',
        'format' => 'text'
    ],
];
$columns[] = ['class' => 'yii\grid\ActionColumn'];
?>

<?= $this->render('_flash')?>

<div class='row'>
    <div class="col-sm-10"></div>
    <div class="col-sm-2"><a href='<?= Yii::$app->url->toRoute('/loan/create') ?>'><button class="btn btn-warning button button-warning">Add new Loan</button></a></div>
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
        'dataProvider' => $loanProvider,
        'columns' => $columns,
    ]);
    ?>
    <div>