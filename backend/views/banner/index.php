<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Banners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index">

    <h1><?= Html::encode($this->title) ?></h1>

   <!-- <p>
        <?/*= Html::a('Create Banner', ['create'], ['class' => 'btn btn-success']) */?>
    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'name',
            [
                'label'=>'Բաններ',
                'format'=>'html',
                'value' => function($data){
                    $return = '';
                    if($data->img) {
                        if(strpos($data->img, '.swf')) {
                            $return = $data->img;
                        } else {
                            $return = '<img src="/banners/'.$data->img.'">';
                        }
                    }
                    return $return;
                }
            ],
            'link',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
