<?php use yii\helpers\Url;?>
<div class="single_sidebar">
    <h2><span><?=$name?></span></h2>
    <ul class="spost_nav">
    <?php foreach($newses as $news):?>
        <li>
            <div class="media wow fadeInDown">
                <a href="<?=Url::toRoute($pref.'news/'.$news->id)?>" class="media-left">
                    <img src="/frontend/web/<?=$upload?>thumbnails/<?=$news->id?>.jpg" alt="<?=$news->title?>" title="<?=$news->title?>">
                </a>
                <div class="media-body">
                    <a href="<?=Url::toRoute($pref.'news/'.$news->id)?>" class="cat_title">
                        <span class="news_time"><?=date('H:i d.m.Y', strtotime($news->published))?></span><br />
                        <?=$news->title?>
                    </a>
                </div>
            </div>
        </li>
    <?php endforeach?>
    </ul>
</div>