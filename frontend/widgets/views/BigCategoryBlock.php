<?php
use yii\helpers\Url;
use common\models\News;
?>
<div class="col-md-6 big_photo_category">
	<div class="single_post_content" id="cat_<?=$id?>">
		<h2><span><a class="category_title" href="<?=Url::toRoute($pref.'category/'.$id)?>"><?=$title?></a></span></h2>
	<?php
	if($news):
	    $news = $news->news;
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
                            <?=News::cut_title($news->title, 50)?>
                            <br /> <span class="news_time"><?=date('H:i d.m.Y', strtotime($news->published))?></span>
                        </a>
					</figcaption>
					<p><?=News::cut_title($news->content, 150)?></p>
				</figure>
			</li>
		</ul>
		<?php endif?>
	</div>
</div>
