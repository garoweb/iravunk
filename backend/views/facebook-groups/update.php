<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FacebookGroups */

$this->title = 'Update Facebook Groups: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Facebook Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="facebook-groups-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
