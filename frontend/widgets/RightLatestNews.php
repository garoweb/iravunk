<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\models\News;
use common\models\RuNews;
use common\models\SimNews;
use common\models\RuSimNews;

class RightLatestNews extends Widget
{

    public $lang;
    public function run()
    {
        switch($this->lang) {
            case 'ru':
                $name = 'НОВОСТИ';
                $pref = '/ru/';
                $upload = 'ru_';
                $latestNews = RuNews::find()->select('id, title, published')->where(['is_published' => 1, 'place' => 2])->orWhere(['is_published' => 1, 'place' => 3])->addOrderBy('id DESC')->limit(30)->all();
            break;
            case 'sim':
                $name = 'ԼՈՒՐԵՐ';
                $pref = '/sim/';
                $upload = 'sim_';
                $latestNews = SimNews::find()->select('id, title, published')->where(['is_published' => 1, 'place' => 2])->orWhere(['is_published' => 1, 'place' => 3])->addOrderBy('id DESC')->limit(30)->all();
            break;
            default:
                $name = 'ԼՈՒՐԵՐ';
                $pref = '';
                $upload = '';
                $latestNews = News::find()->select('id, title, published')->where(['is_published' => 1, 'place' => 2])->orWhere(['is_published' => 1, 'place' => 3])->addOrderBy('id DESC')->limit(30)->all();
            break;
        }

        return $this->render('RightLatestNews', compact('latestNews', 'name', 'pref', 'upload'));
    }
}