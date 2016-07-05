<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\models\News;
use common\models\RuNews;
use common\models\SimNews;

class HomeSlider extends Widget
{

    public $lang;
    public function run()
    {
        switch($this->lang) {
            case 'ru':
                $newses = RuNews::find()->select('id, title, content')->addOrderBy('id DESC')->where(['is_published' => 1, 'important' => 1])->limit(5)->all();
                $pref = '/ru/';
                $upload = 'ru_';
            break;
            case 'sim':
                $newses = SimNews::find()->select('id, title, content')->addOrderBy('id DESC')->where(['is_published' => 1, 'important' => 1])->limit(5)->all();
                $pref = '/sim/';
                $upload = 'sim_';
            break;
            default:
                $pref = '';
                $upload = '';
                $newses = News::find()->select('id, title, content')->addOrderBy('id DESC')->where(['is_published' => 1, 'important' => 1])->limit(5)->all();
            break;
        }

        return $this->render('HomeSlider', compact('newses', 'pref', 'upload'));
    }
}