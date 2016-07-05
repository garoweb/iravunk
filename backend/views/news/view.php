<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="news-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
				'method' => 'post',
			],
		]) ?>

		<!-- Trigger the modal with a button -->
		<a href="#myModal" id="sharing_button" data-toggle="modal" data-target="#myModal" onclick="share_process()"><img src="/backend/web/img/facebook.png" height="40"></a>
		<!-- Modal -->
	</p>
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Ընթացքի մեջ է, չանջատել! Սպասեք ավարտին</h4>
				</div>
				<div class="modal-body">

				</div>
			</div>

		</div>
	</div>
<p><img src="/thumb.php?src=/frontend/web/uploads/<?=$model->id?>.png&h=100" ></p>
	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id',
			'title',
			'content:ntext',
			'video',
			'meta_key',
			'created',
			'published',
			'is_published',
			'important',
			'hits',
		],
	]) ?>



</div>

<div>
	<iframe src="/news/<?=$model->id?>" width="100%" height="500"></iframe>
</div>


<script>
    function share_process() {
        var share_button = $('#sharing_button');
        if(share_button.hasClass('clicked')) {
            return false;
        }
        share_button.addClass('clicked');
		//var fb = window.open("https://www.facebook.com/sharer.php?u=iravunk.com/news/<?=$model->id?>&t=<?=trim($model->title)?>", "facebook", "width=400,height=300");
        $('.modal-body').html('<p><img src="/img/status.gif"></p>');
		//setTimeout(function() {
		//	fb.close();
			$.get( "/admins/facebook/share-news?id=<?=$model->id?>", function( data ) {
            $('.modal-title').text('Ավարտ');
            $('.modal-body').html(data);
		});
		//},2000);
    }
</script>