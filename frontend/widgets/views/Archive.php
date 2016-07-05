<?php use yii\helpers\Url;?>
<div class="single_sidebar wow fadeInDown" id="archive">
    <h2><span><?=$name?></span></h2>
    <form action="<?=Url::toRoute($pref.'category')?>">
        <input type="hidden" name="date" id="selected_date">
    </form>
    <div id="datepicker" style="width: 340px">

    </div>
</div>