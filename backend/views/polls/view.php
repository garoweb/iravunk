<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Polls */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Polls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="polls-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Ավելացնել պատասխանների տարբերակներ', ['/polls-answers/create', 'poll_id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Դիտել պատասխանների տարբերակները', ['/polls-answers/index', 'SearchPollsAnswers[poll_id]' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'question',
            'created',
            'is_published',
        ],
    ]) ?>

</div>
