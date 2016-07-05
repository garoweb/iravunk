<?php
use yii\helpers\Url;
use common\models\News;
?>
<div class="col-md-6">
	<div class="single_post_content">
		<h2><span><a class="category_title" href="<?=Url::toRoute($pref.'category/'.$id)?>"><?=$title?></a></span></h2>
	<?php
	if($newses):
	$news = $newses[0]->news;
	unset($newses[0]);
	?>
		<ul class="business_catgnav wow fadeInDown">
			<li>
				<figure class="bsbig_fig">
					<a href="<?=Url::toRoute($pref.'news/'.$news->id)?>" class="featured_img">
						<img src="/thumb.php?src=/frontend/web/<?=$upload?>uploads/<?=$news->id?>.png&h=216&w=325" alt="<?=$news->title?>" title="<?=$news->title?>">
						<span class="overlay"></span>
					</a>
					<figcaption>
						<a href="<?=Url::toRoute($pref.'news/'.$news->id)?>">
							<span class="news_time"><?=date('H:i d.m.Y', strtotime($news->published))?></span> <br />
							<?=News::cut_title($news->title, 50)?>...
						</a>
					</figcaption>
					<p><?=News::cut_title($news->content, 150)?>...</p>
				</figure>
			</li>
		</ul>
		<ul class="spost_nav">
			<?php foreach($newses as $news_s): $news = $news_s->news?>
			<li>
				<div class="media wow fadeInDown">
					<a href="<?=Url::toRoute($pref.'news/'.$news->id)?>" class="media-left">
						<img src="/frontend/web/<?=$upload?>thumbnails/<?=$news->id?>.jpg" alt="<?=$news->title?>" title="<?=$news->title?>">
					</a>
					<div class="media-body">
						<a href="<?=Url::toRoute($pref.'news/'.$news->id)?>">
							<span class="news_time"><?=date('H:i d.m.Y', strtotime($news->published))?></span> <br />
							<?=News::cut_title($news->title, 50)?>...
						</a>
					</div>
				</div>
			</li>
			<?php endforeach?>
		</ul>
		<?php endif?>
	</div>
</div>