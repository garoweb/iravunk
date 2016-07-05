<?php
use yii\helpers\Url;
use common\models\News;
?>
    <!-- Set up your HTML -->
    <div class="slick_slider">
        <?php foreach($newses as $news):?>
        <div class="single_iteam">
            <a href="<?=Url::toRoute($pref.'news/'.$news->id)?>">
                <img src="/thumb.php?src=/frontend/web/<?=$upload?>uploads/<?=$news->id?>.png&h=448&w=710" alt="<?=$news->title?>" title="<?=$news->title?>">
            </a>
            <div class="slider_article">
                <h2><a class="slider_tittle" href="<?=Url::toRoute($pref.'news/'.$news->id)?>"><?=$news->title?></a></h2>
                <p><?=News::cut_title($news->content, 170)?>...</p>
            </div>
        </div>
        <?php endforeach?>
    </div>
