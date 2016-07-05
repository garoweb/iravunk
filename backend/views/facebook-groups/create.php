<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\FacebookGroups */

$this->title = 'Create Facebook Groups';
$this->params['breadcrumbs'][] = ['label' => 'Facebook Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="facebook-groups-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
