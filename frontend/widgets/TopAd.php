<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\models\Banner;
use common\models\RuBanners;
class TopAd extends Widget
{
    public $lang;
    public function run()
    {
        switch($this->lang) {
            case 'ru':
                $banner = RuBanners::find()->where(['id' => 1])->one();
                $upload = 'ru_';
            break;
            default:
                $banner = Banner::find()->where(['id' => 1])->one();
                $upload = '';
            break;
        }

        return $view = $this->render('TopAd', compact('banner', 'upload'));
    }
}