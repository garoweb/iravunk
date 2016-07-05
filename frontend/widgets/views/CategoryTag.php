<?php use yii\helpers\Url;?>
<div class="footer_widget wow fadeInDown">
    <h2><?=$name?></h2>
    <ul class="tag_nav">
    <?php foreach($categories as $category):?>
        <li><a href="<?=Url::toRoute($pref.'category/'.$category->id)?>"><?=$category->title?></a></li>
    <?php endforeach?>
    </ul>
</div>