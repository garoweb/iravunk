<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Photos */

$this->title = 'Ավելացնել Նկար';
$this->params['breadcrumbs'][] = ['label' => 'Ֆոտոռեպորտաժ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
