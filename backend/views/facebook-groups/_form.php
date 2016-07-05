<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;
/* @var $this yii\web\View */
/* @var $model backend\models\FacebookGroups */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="facebook-groups-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_id')->textInput(['maxlength' => true]) ?>
	
	<div class="row">
		<div class="col-md-6">
		<?php 
			$categories = Category::find()->all();
			$cat_list = [0 => 'none'];
			foreach($categories as $category) {
				$cat_list[$category->id] = $category->title;
			}
		?>
			<?= $form->field($model, 'category_id')->dropDownList($cat_list) ?>
		</div>
	</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
