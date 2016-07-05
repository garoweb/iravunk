<div class="single_post_content">
	<h2><span><?=$name?></span></h2>
	<ul class="photograph_nav  wow fadeInDown">
    <?php foreach($photos as $photo):?>
		<li>
			<div class="photo_grid">
				<figure class="effect-layla">
					<a class="fancybox-buttons" data-fancybox-group="button" href="/<?=$upload?>photos/<?=$photo->id?>.png" title="<?=$photo->title?>">
                        <img src="/thumb.php?src=/frontend/web/<?=$upload?>photos/<?=$photo->id?>.png&h=390&w=231" alt="<?=$photo->title?>" title="<?=$photo->title?>">
					</a>
				</figure>
			</div>
		</li>
    <?php endforeach?>
	</ul>
</div>