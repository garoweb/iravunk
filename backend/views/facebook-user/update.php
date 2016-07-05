<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FacebookUser */

$this->title = 'Update Facebook User: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Facebook Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="facebook-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
