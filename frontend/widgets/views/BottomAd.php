<div class="single_post_content">
    <h2><span><a href="<?=$banner->link?>" target="_blank" class="category_title"><?=$banner->name?></a></span></h2>
    <?php if($banner->img):?>
        <a href="<?=$banner->link?>" target="_blank">
            <img src="/<?=$pref?>banners/<?=$banner->img?>" class="img-responsive">
        </a>
    <?php endif?>
</div>