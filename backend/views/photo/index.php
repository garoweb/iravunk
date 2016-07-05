<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchPhoto */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ֆոտոռեպորտաժ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Ավելացնել նկար', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'label'=>'Նկար',
                'format'=>'html',
                'value' => function($data){
                    return '<img src="/thumb.php?src=/frontend/web/photos/'.$data->id.'.png&h=100" >';
                }
            ],
            'created:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
