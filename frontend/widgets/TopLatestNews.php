<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\models\News;
use common\models\RuNews;
use common\models\SimNews;

class TopLatestNews extends Widget
{

    public $lang;
    public function run()
    {
        switch($this->lang) {
            case 'ru':
                $name = 'КОРОТКО';
                $upload = 'ru_';
                $pref = '/ru/';
                $latestNews = RuNews::find()->select('id, title')->where(['is_published' => 1, 'place' => 1])->orWhere(['is_published' => 1, 'place' => 3])->addOrderBy('id DESC')->limit(20)->all();
            break;
            case 'sim':
                $name = 'ԿԱՐՃ ԼՈՒՐԵՐ';
                $upload = 'sim_';
                $pref = '/sim/';
                $latestNews = SimNews::find()->select('id, title')->where(['is_published' => 1, 'place' => 1])->orWhere(['is_published' => 1, 'place' => 3])->addOrderBy('id DESC')->limit(20)->all();
            break;
            default:
                $name = 'ԿԱՐՃ ԼՈՒՐԵՐ';
                $upload = '';
                $pref = '';
                $latestNews = News::find()->select('id, title')->where(['is_published' => 1, 'place' => 1])->orWhere(['is_published' => 1, 'place' => 3])->addOrderBy('id DESC')->limit(20)->all();
            break;
        }
        return $this->render('TopLatestNews', compact('latestNews', 'name', 'upload', 'pref'));
    }
}