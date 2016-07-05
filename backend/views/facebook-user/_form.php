<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;
/* @var $this yii\web\View */
/* @var $model backend\models\FacebookUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="facebook-user-form">

	<?php $form = ActiveForm::begin(); ?>

	<div class="row">
		<div class="col-md-6">
			<?php
			$categories = Category::find()->all();
			$cat_list = [0 => 'Rus'];
			foreach($categories as $category) {
				$cat_list[$category->id] = $category->title;
			}
			?>
			<?= $form->field($model, 'categories')->dropDownList($cat_list, ['multiple' => true, 'size' => 10]) ?>
		</div>
	</div>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
