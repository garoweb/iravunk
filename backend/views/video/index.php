<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchVideo */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Video', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    global $users;
    $users = ArrayHelper::map(User::find()->select('id, username')->asArray()->all(), 'id', 'username'); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'link',
            'created',
            [
                'value' => function($data) {
                               global $users;
                               return $data->user_id ? $users[$data->user_id] : null;
                           },
                'attribute' => 'user_id',
                'filter' => Html::activeDropDownList($searchModel, 'user_id', $users, ['class'=>'form-control','prompt' => 'Select Admin'])
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
