<?php use yii\helpers\Url;?>

<div class="latest_post" >
    <h2><span><a href="<?=Url::toRoute('/ru/category')?>" class="category_title">Լուրեր</a></span></h2>
    <div class="latest_post_container">
        <div id="prev-button" class="prev-button"><i class="fa fa-chevron-up"></i></div>
        <ul class="latest_postnav" id="latest_postnav1">
            <?php foreach($latestNews as $news):?>
                <li>
                    <div class="media">
                        <a href="<?=Url::toRoute('/ru/news/'.$news->id)?>" class="media-left">
                            <img src="/thumb.php?src=/frontend/web/ru_uploads/<?=$news->id?>.png&h=70&w=90" alt="<?=$news->title?>" title="<?=$news->title?>">
                        </a>
                        <div class="media-body">
                            <a href="<?=Url::toRoute('/ru/news/'.$news->id)?>" class="catg_title">
                                <span class="news_time"><?=date('H:i d.m.Y', strtotime($news->published))?></span><br />
                                <?=$news->title?>
                            </a>
                        </div>
                    </div>
                </li>
            <?php endforeach?>
        </ul>
        <div id="next-button" class="next-button"><i class="fa fa-chevron-down"></i></div>
    </div>
</div>
