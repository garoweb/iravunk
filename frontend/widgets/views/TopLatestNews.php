<?php use yii\helpers\Url; ?>
<div class="latest_newsarea">
    <span><?=$name?></span>
    <ul id="ticker01" class="news_sticker">
        <?php foreach($latestNews as $news):?>
            <li>
                <a href="<?=Url::toRoute($pref.'news/'.$news->id)?>"><img src="/frontend/web/<?=$upload?>thumbnails/<?=$news->id?>.jpg" width="60" height="40" alt="<?=$news->title?>">
                    <?=$news->title?>
                </a>
            </li>
        <?php endforeach?>
    </ul>
</div>