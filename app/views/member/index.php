<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Member;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Members';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Member', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // tanya bang anto id perlu ditampilin gak?'id',
            'name',
            'code',
            'date_of_birth',
            //'join_date',
            //'expired_date',
            [
                "attribute" => "type",
                "filter" => Member::listType()
            ],
            [
                "attribute" => "gender",
                "filter" => Member::listGender()
            ],
            //'address',
            //'phone',
            //'photo',
            //'password',
            [
                "attribute" => "status",
                "filter" => Member::listStatus()
            ],            
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            'email:email',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
