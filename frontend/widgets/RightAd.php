<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\models\Banner;
use common\models\RuBanners;
class RightAd extends Widget
{

    public $id;
    public $lang;
    public function run()
    {
        switch($this->lang) {
            case 'ru':
                $upload = 'ru_';
                $banner = RuBanners::find()->where(['id' => $this->id])->one();
            break;
            default:
                $upload = '';
                $banner = Banner::find()->where(['id' => $this->id])->one();
            break;
        }
        return $this->render('RightAd', compact('banner', 'upload'));
    }
}