<?php use yii\helpers\Url;?>
<div class="footer_widget wow fadeInLeftBig">
    <h2><?=$about?></h2>
    <ul class="tag_nav">
        <?php foreach($pages as $page):?>
            <li><a href="<?=Url::toRoute($pref.'page/'.$page->id)?>"><?=$page->title?></a></li>
        <?php endforeach?>
    </ul>
    <h2><?=$oldSites?></h2>
    <ul class="tag_nav">
        <li><a href="http://old.iravunk.com" target="_blank"><img src="/img/footer_img.jpg" class="img-responsive" /> 2012-2016</li>
        <li><a href="http://old.iravunk.com/indexold.php" target="_blank"><img src="http://old.iravunk.com/iskakan/images/mainindex.jpg" class="img-responsive" /> 2008-2012</li>
        <li><a href="http://iravunk.com" target="_blank"><img src="/img/footer_img_left.jpg" height="100"></a></li>
    </ul>
	<!-- Qanon.am , HTML code for http://iravunk.com -->
		<script type="text/javascript">
			var refer='refer=' + escape(document.referrer) + '&page=' + escape(window.location.href) + '&razresh=' + screen.width + 'x' + screen.height + '&cvet=' + screen.colorDepth + '&rand=' + Math.random(); 
			document.write('<a href="//qanon.am/?fromsite=843"> <img src="//qanon.am/img.php?id=843&' + refer + '"  alt="Qanon.am" width="88" height="15"> <\/a>');
		</script>
		<noscript><div><a href="//qanon.am/?fromsite=843" onclick="this.target='_blank'"><img src="//qanon.am/img.php?id=843" alt="Qanon.am" width="88" height="15"></a></div></noscript>
	<!-- /Qanon.am , HTML code for http://iravunk.com -->

</div>