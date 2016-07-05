<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = 'Ավելացնել Նորություն';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model', 'categories')) ?>

</div>
