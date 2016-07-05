<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PollsAnswers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="polls-answers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'poll_id')->textInput() ?>

    <?= $form->field($model, 'answer')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
