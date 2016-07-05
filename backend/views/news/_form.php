<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'video')->textInput(['maxlength' => true, 'placeholder' => 'https://www.youtube.com/watch?v=ivjPQZ_3-xM']) ?>

	<?= $form->field($model, 'meta_key')->textInput(['maxlength' => true]) ?>


	<?php if($model->id): ?>
        <?= $form->field($model, 'published')->textInput() ?>
		<img src="/thumb.php?src=/frontend/web/uploads/<?=$model->id?>.png&h=100" >
	<?php endif;?>
	<?= $form->field($model, 'imageFile')->fileInput() ?>
	<div class="categories_list">
		<?= $form->field($model, 'categories')->checkboxList($categories)?>
	</div>
	<?= $form->field($model, 'is_published')->checkbox() ?>

	<?= $form->field($model, 'important')->checkbox() ?>

	<div class="row">
		<div class="col-md-6">
			<?= $form->field($model, 'place')->dropDownList([0 => 'Ոչ մի տեղ', 1 => 'Կարճ լուրեր', 2 => 'Լուրեր', 3 => 'Կարճ լուրեր և Լուրեր']) ?>
		</div>
	</div>


	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
<script src="//cdn.ckeditor.com/4.5.7/full/ckeditor.js"></script>
<script>
	CKEDITOR.replace( 'News[content]' );
	
	window.onload = function() {
		$('.news-form').click(function() {
			console.log(CKEDITOR.instances);
			$('#news-content').val(CKEDITOR.instances['news-content'].getData());
		});
	}
	
	
</script>
