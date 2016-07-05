<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MerMasin */

$this->title = 'Ավելացնել Նորություն';
$this->params['breadcrumbs'][] = ['label' => 'Մեր Մասին', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mer-masin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
