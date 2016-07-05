<?php
use yii\helpers\Url;
?>
<ul class="nav navbar-nav main_nav">
    <li class="active"><a href="<?=Url::toRoute('/')?>"><span class="fa fa-home desktop-home"></span><span class="mobile-show">ԳԼԽԱՎՈՐ</span></a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">ԲԱԺԻՆՆԵՐ</a>
        <ul class="dropdown-menu" role="menu">
            <?php foreach($categories as $category):?>
                <li><a href="<?=Url::toRoute('/sim/category/'.$category->id)?>"><?=$category->title?></a></li>
            <?php endforeach?>
        </ul>
    </li>
    <li><a href="http://zaruhi.com/" target="_blank">Ախ Կանայք</a></li>
    <!--<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">О нас</a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="<?/*=Url::toRoute('/sim/mermasin')*/?>">Новости</a></li>
            <?php /*foreach($pages as $page):*/?>
                <li><a href="<?/*=Url::toRoute('/ru/page/'.$page->id)*/?>"><?/*=$page->title*/?></a></li>
            <?php /*endforeach*/?>
        </ul>
    </li>-->
</ul>

<form action="<?=Url::toRoute('/sim/category')?>">
    <div class="pull-right col-md-3" style="padding-top: 8px">
        <div class="col-xs-9" style="padding: 0">
            <input type="text" name="search" class="form-control form-inline" placeholder="search">
        </div>
        <div class="col-xs-3">
            <button type="submit" class="btn btn-orange">Go</button>
        </div>
    </div>
</form>