<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
	<script src="/backend/web/ckeditor/ckeditor.js"></script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
	<?php
	NavBar::begin([
		'brandLabel' => 'Iravunk',
		'brandUrl' => Yii::$app->homeUrl,
		'options' => [
			'class' => 'navbar-inverse navbar-fixed-top',
		],
	]);
	if (Yii::$app->user->isGuest) {
		$menuItems = [];
		$menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
	} else {
		$menuItems = [

            ['label' => 'Հայերեն',
                'items' => [
                    ['label' => 'Լուրեր', 'url' => ['/news/index', 'sort' =>'-id']],
                    ['label' => 'Տեսանյութեր', 'url' => ['/video/index', 'sort' =>'-id']],
                    ['label' => 'Բաժիններ', 'url' => ['/category/index', 'sort' =>'sort']],
                    ['label' => 'Ֆոտոռեպորտաժ', 'url' => ['/photo/index', 'sort' =>'-id']],
                    ['label' => 'Էջեր', 'url' => ['/page/index']],
                    ['label' => 'Բաններներ', 'url' => ['/banner/index']],
                    ['label' => 'Հարցումներ', 'url' => ['/polls/index', 'sort' =>'-id']],
                    ['label' => 'Մեր Մասին', 'url' => ['/mer-masin/index']],
                ]
            ],

            ['label' => 'Русский',
                'items' => [
                    ['label' => 'Новости', 'url' => ['/ru-news/index', 'sort' =>'-id']],
                    ['label' => 'Видео', 'url' => ['/ru-video/index', 'sort' =>'-id']],
                    ['label' => 'Категории', 'url' => ['/ru-category/index']],
                    ['label' => 'Фоторепортаж', 'url' => ['/ru-photo/index', 'sort' =>'-id']],
                    ['label' => 'Страницы', 'url' => ['/ru-pages/index']],
                    ['label' => 'Баннеры', 'url' => ['/ru-banners/index']],
                    ['label' => 'О нас', 'url' => ['/ru-mermasin/index', 'sort' =>'-id']],
                    ['label' => 'Опросы', 'url' => ['/ru-polls/index']],
                ]
            ],

            ['label' => 'ՍԻՄ Հայերեն',
                'items' => [
                    ['label' => 'Լուրեր', 'url' => ['/sim-news/index', 'sort' =>'-id']],
                    ['label' => 'Տեսանյութեր', 'url' => ['/sim-video/index', 'sort' =>'-id']],
                    ['label' => 'Բաժիններ', 'url' => ['/sim-category/index', 'sort' =>'sort']],
                    ['label' => 'Ֆոտոռեպորտաժ', 'url' => ['/sim-photo/index', 'sort' =>'-id']],
                    ['label' => 'Էջեր', 'url' => ['/sim-page/index']],
                 //   ['label' => 'Բաններներ', 'url' => ['/sim-banner/index']],
                ]
            ],

            ['label' => 'СИМ Русский',
                'items' => [
                    ['label' => 'Новости', 'url' => ['/ru-sim-news/index', 'sort' =>'-id']],
                    ['label' => 'Видео', 'url' => ['/ru-sim-video/index', 'sort' =>'-id']],
                    ['label' => 'Категории', 'url' => ['/ru-sim-category/index']],
                    ['label' => 'Фоторепортаж', 'url' => ['/ru-sim-photo/index', 'sort' =>'-id']],
                    ['label' => 'Страницы', 'url' => ['/ru-sim-page/index']],
                 //   ['label' => 'Баннеры', 'url' => ['/ru-sim-banner/index']],
                ]
            ],
            ['label' => 'Users', 'url' => ['/user/index']],
			['label' => 'Facebook',
				'items' => [
					['label' => 'Facebook groups', 'url' => ['/facebook-groups/index']],
					['label' => 'Facebook users', 'url' => ['/facebook-user/index']],
				]
			]
		];
		$menuItems[] = [
			'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
			'url' => ['/site/logout'],
			'linkOptions' => ['data-method' => 'post']
		];
	}
	echo Nav::widget([
		'options' => ['class' => 'navbar-nav navbar-right'],
		'items' => $menuItems,
	]);
	NavBar::end();
	?>

	<div class="container">
		<?= Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]) ?>
		<?= Alert::widget() ?>
		<?= $content ?>
	</div>
</div>

<footer class="footer">
	<div class="container">
		<p class="pull-left">&copy; Iravunk.com <?= date('Y') ?></p>

		<p class="pull-right">Powered by <a href="http://web.armsolid.ru" target="_blank">WebandHost</a></p>
	</div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
