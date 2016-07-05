<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MerMasin */
/* @var $form yii\widgets\ActiveForm */
?>
<script src="//cdn.ckeditor.com/4.5.7/full/ckeditor.js"></script>
<div class="mer-masin-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php if($model->id): ?>
        <img src="/thumb.php?src=/frontend/web/about_uploads/<?=$model->id?>.jpg&h=100" >
    <?php endif;?>
    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'meta_key')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'type')->dropDownList([0 => 'Աջ կողմի նորություն', 1 => 'Ձախ կողմի նորություն', 2 => 'Բոլոր տեղերում']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    CKEDITOR.replace( 'MerMasin[content]' );
</script>