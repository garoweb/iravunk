<?php
use yii\helpers\Url;
?>
<ul class="nav navbar-nav main_nav">
    <li <?php if(!isset($mermasin)):?>class="active"><?php endif?><a href="<?=Url::toRoute('/')?>"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Գլխավոր</span></a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Բաժիններ</a>
        <ul class="dropdown-menu" role="menu">
            <?php foreach($categories as $category):?>
                <li><a href="<?=Url::toRoute('category/'.$category->id)?>"><?=$category->title?></a></li>
            <?php endforeach?>
            <li><a href="<?=Url::toRoute('category')?>">ԼՈՒՐԵՐ</a></li>
        </ul>
    </li>
    <li><a href="<?=Url::toRoute('/category/25')?>">ՎԵՐԼՈՒԾՈՒԹՅՈՒՆ</a></li>
    <li><a href="<?=Url::toRoute('/category/16')?>">ԱՌՈՂՋՈՒԹՅՈՒՆ</a></li>
    <li><a href="<?=Url::toRoute('video')?>">Տեսանյութեր</a></li>
    <li><a href="http://zaruhi.com/" target="_blank">Ախ Կանայք</a></li>
    <li><a href="<?=Url::toRoute('/category/17')?>">ՓԱՆՋՈՒՆԻ</a></li>
    <li class="dropdown <?php if(isset($mermasin)) echo 'active'?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Մեր Մասին</a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="<?=Url::toRoute('/mermasin')?>">Նորություններ</a></li>
            <?php foreach($pages as $page):?>
                <li><a href="<?=Url::toRoute('page/'.$page->id)?>"><?=$page->title?></a></li>
            <?php endforeach?>
        </ul>
    </li>


</ul>
<form action="<?=Url::toRoute('category')?>">
<div class="pull-right col-md-2" style="padding-top: 8px; padding-left: 0">
        <div class="col-xs-9" style="padding: 0">
            <input type="text" name="search" class="form-control form-inline" placeholder="Որոնել">
        </div>
        <div class="col-xs-3" style="padding-left: 8px">
            <button type="submit" class="btn btn-orange">GO</button>
        </div>
</div>
</form>