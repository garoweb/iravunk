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
            ['label' => 'Հայերեն', 'url' => ['/']],
            ['label' => 'Новости', 'url' => ['/ru-news/index', 'sort' =>'-id']],
            ['label' => 'Видео', 'url' => ['/ru-video/index', 'sort' =>'-id']],
            ['label' => 'Категории', 'url' => ['/ru-category/index']],
            ['label' => 'Фоторепортаж', 'url' => ['/ru-photo/index', 'sort' =>'-id']],
            ['label' => 'Страницы', 'url' => ['/ru-pages/index']],
            ['label' => 'Баннеры', 'url' => ['/ru-banners/index']],
            ['label' => 'О нас', 'url' => ['/ru-mermasin/index', 'sort' =>'-id']],
            ['label' => 'Опросы', 'url' => ['/ru-polls/index']],
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
