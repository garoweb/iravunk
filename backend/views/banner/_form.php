<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php if($model->img): ?>
        <embed src="/banners/<?=$model->img?>"></embed>
    <?php endif;?>
    <?= $form->field($model, 'imageFile')->fileInput()?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true])?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true])?>
    <?= $form->field($model, 'text')->textarea(['maxlength' => true])?>
    <?= $form->field($model, 'code')->textarea()?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
