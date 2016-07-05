<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Facebook Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="facebook-groups-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Facebook Groups', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'group_id',
			'category_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
