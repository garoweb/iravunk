<div class="single_sidebar wow fadeInDown">
    <h2><span><a href="<?=$banner->link?>" target="_blank" class="category_title"><?=$banner->name?></a></span></h2>

    <?php if($banner->code):?>
        <div style="text-align: center; width: 100%">
            <?=$banner->code?>
        </div>
    <?php elseif($banner->img):?>
        <a class="sideAdd" href="<?=$banner->link?>" target="_blank">
            <?php if(strpos($banner->img, '.swf')):?>
                <embed width="100%" height="250" src="/<?=$upload?>banners/<?=$banner->img?>"  pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>
            <?php else:?>
                <img src="/<?=$upload?>banners/<?=$banner->img?>">
            <?php endif?>
        </a>
    <?php endif?>
    <?php if($banner->text):?>
        <div class="col-md-12">
            <?=$banner->text?>
        </div>
    <?php endif?>
</div>