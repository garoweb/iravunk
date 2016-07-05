<?php use yii\helpers\Url;?>
<div class="related_post">
	<h2>Այս Թեմայով <i class="fa fa-thumbs-o-up"></i></h2>
	<ul class="spost_nav wow fadeInDown animated">
	<?php foreach($newses as $news):?>
		<li>
			<div class="media">
				<a class="media-left" href="<?=Url::toRoute('news/'.$news->id)?>">
                    <img src="/thumb.php?src=/frontend/web/uploads/<?=$news->id?>.png&h=70&w=90" alt="<?=$news->title?>" title="<?=$news->title?>">
				</a>
				<div class="media-body">
					<a class="catg_title" href="<?=Url::toRoute('/site/news')?>"> <?=$news->title?></a>
				</div>
			</div>
		</li>
	<?php endforeach?>
	</ul>
</div>