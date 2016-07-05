<?php use yii\helpers\Url;?>

<div class="single_sidebar" id="cat_23">
    <h2><span><a class="category_title" href="<?=Url::toRoute('category/'.$id)?>"><?=$title?></a></span></h2>
    <?php
    if($news):
    $news = $news->news;
    ?>
    <figure class="bsbig_fig">
        <a href="<?=Url::toRoute('news/'.$news->id)?>" class="featured_img">
            <img src="/thumb.php?src=/frontend/web/uploads/<?=$news->id?>.png&h=216&w=325" alt="<?=$news->title?>" title="<?=$news->title?>">
            <span class="overlay"></span>
        </a>
        <figcaption>
            <a href="<?=Url::toRoute('news/'.$news->id)?>">
                <?=mb_substr($news->title, 0, 50, 'utf-8')?>
                <br /> <span class="news_time"><?=date('H:i d.m.Y', strtotime($news->published))?></span>
            </a>
        </figcaption>
        <p><?=mb_substr(strip_tags($news->content), 0, 150, 'utf-8')?></p>
    </figure>
    <?php endif?>
</div>
