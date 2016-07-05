<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use backend\models\User;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchMerMasin */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Մեր Մասին (Նորություններ)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mer-masin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Ավելացնել Նորություն', ['create'], ['class' => 'btn btn-success']) ?>
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
            'meta_key',
            'created:datetime',
            'hits',
            'type',
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
