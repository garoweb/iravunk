<?php
use yii\helpers\Url;
?>
<ul class="nav navbar-nav main_nav">
    <li class="active"><a href="<?=Url::toRoute('/ru')?>"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Главная</span></a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">РАЗДЕЛЫ</a>
        <ul class="dropdown-menu" role="menu">
            <?php foreach($categories as $category):?>
                <li><a href="<?=Url::toRoute('/ru/category/'.$category->id)?>"><?=$category->title?></a></li>
            <?php endforeach?>
        </ul>
    </li>
    <li><a href="<?=Url::toRoute('/ru/category/11')?>">Аналитика</a></li>
    <li><a href="<?=Url::toRoute('/ru/video')?>">Видео</a></li>
    <li><a href="<?=Url::toRoute('/ru/category/14')?>" target="_blank">Женский журнал</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">О нас</a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="<?=Url::toRoute('/ru/mermasin')?>">Новости</a></li>
            <?php foreach($pages as $page):?>
                <li><a href="<?=Url::toRoute('/ru/page/'.$page->id)?>"><?=$page->title?></a></li>
            <?php endforeach?>
        </ul>
    </li>
</ul>

<form action="<?=Url::toRoute('/ru/category')?>">
    <div class="pull-right col-md-3" style="padding-top: 8px">
        <div class="col-xs-9" style="padding: 0">
            <input type="text" name="search" class="form-control form-inline" placeholder="search">
        </div>
        <div class="col-xs-3">
            <button type="submit" class="btn btn-orange">Go</button>
        </div>
    </div>
</form>