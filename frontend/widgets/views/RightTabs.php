<?php use yii\helpers\Url; ?>
<div class="single_sidebar wow fadeInDown">
    <div class="latest_post" >
        <h2><span><a href="<?=Url::toRoute('video')?>" class="category_title"><?=$name?></a></span></h2>
        <div class="latest_post_container" style="height: 250px; overflow: hidden">
            <div id="prev-button2" class="prev-button"><i class="fa fa-chevron-up"></i></div>
            <ul class="latest_postnav" id="latest_postnav2">
                <?php foreach($videos as $video):?>
                    <li>
                        <div class="video_area">
                            <iframe width="100%" height="250" src="http://www.youtube.com/embed/<?=$video->get_video_id()?>?feature=player_detailpage" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </li>
                <?php endforeach?>
            </ul>
            <div id="next-button2" class="next-button"><i class="fa  fa-chevron-down"></i></div>
        </div>
    </div>
</div>
