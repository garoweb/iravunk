<?php
use yii\helpers\Url;
use common\models\News;
?>
<div class="single_post_content news_columns">
    <h2>
        <span>
            <a class="category_title" href="<?=Url::toRoute($pref.'category/'.$category->id)?>"><?=$category->title?></a>
        </span>
    </h2>

    <div class="col-md-4">
        <ul class="spost_nav">
        <?php for($i=0; $i<4; $i++):
            if(isset($newses[$i]))
                $news = $newses[$i]->news;
            else
                break;?>
            <li>
                <div class="media wow fadeInDown">
                    <a href="<?=Url::toRoute($pref.'news/'.$news->id)?>" class="media-left">
                        <img  src="/frontend/web/<?=$upload?>thumbnails/<?=$news->id?>.jpg" alt="<?=$news->title?>" title="<?=$news->title?>">
                    </a>
                    <div class="media-body">
                        <a href="<?=Url::toRoute($pref.'news/'.$news->id)?>" class="catg_title">
                            
                            <?=News::cut_title($news->title, 60)?>...
                        </a>
                    </div>
                </div>
            </li>
        <?php endfor?>
        </ul>
    </div>

    <div class="col-md-4">
        <ul class="spost_nav">
            <?php for($i=4; $i<8; $i++):
                if(isset($newses[$i]))
                    $news = $newses[$i]->news;
                else
                    break;?>
                <li>
                    <div class="media wow fadeInDown">
                        <a href="<?=Url::toRoute($pref.'news/'.$news->id)?>" class="media-left">
                            <img src="/frontend/web/<?=$upload?>thumbnails/<?=$news->id?>.jpg" alt="<?=$news->title?>" title="<?=$news->title?>">
                        </a>
                        <div class="media-body">
                            <a href="<?=Url::toRoute($pref.'news/'.$news->id)?>" class="catg_title">
                                
                                <?=News::cut_title($news->title, 60)?>...
                            </a>
                        </div>
                    </div>
                </li>
            <?php endfor?>
        </ul>
    </div>

    <div class="col-md-4">
        <ul class="spost_nav">
            <?php for($i=8; $i<12; $i++):
                if(isset($newses[$i]))
                    $news = $newses[$i]->news;
                else
                    break;?>
                <li>
                    <div class="media wow fadeInDown">
                        <a href="<?=Url::toRoute($pref.'news/'.$news->id)?>" class="media-left">
                            <img  src="/frontend/web/<?=$upload?>thumbnails/<?=$news->id?>.jpg" alt="<?=$news->title?>" title="<?=$news->title?>">
                        </a>
                        <div class="media-body">
                            <a href="<?=Url::toRoute($pref.'news/'.$news->id)?>" class="catg_title">
                                
                                <?=News::cut_title($news->title, 60)?>...
                            </a>
                        </div>
                    </div>
                </li>
            <?php endfor?>
        </ul>
    </div>

</div>