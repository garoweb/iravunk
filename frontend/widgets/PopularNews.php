<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\models\News;
use common\models\RuNews;
use common\models\SimNews;
use common\models\RuSimNews;

class PopularNews extends Widget
{
    public $lang;
    public function run()
    {
		$date = date('Y-m-d 00:00:00', strtotime('-5 day', time()));
        switch($this->lang) {
            case 'ru':
                $name = 'Популярные';
                $newses = RuNews::find()->addOrderBy('hits DESC')->where(['is_published' => 1])->andWhere("published > '$date'")->limit(4)->all();
                $upload = 'ru_';
                $pref = '/ru/';
            break;
            case 'sim':
                $name = 'Ամենադիտվածները';
                $newses = SimNews::find()->addOrderBy('hits DESC')->where(['is_published' => 1])->andWhere("published > '$date'")->limit(4)->all();
                $upload = 'sim_';
                $pref = '/sim/';
            break;
            default:
                $name = 'Ամենադիտվածները';
                $newses = News::find()->addOrderBy('hits DESC')->where(['is_published' => 1])->andWhere("published > '$date'")->limit(4)->all();
                $upload = '';
                $pref = '';
            break;
        }
        $lang = $this->lang;
        return $this->render('PopularNews', compact('newses', 'name', 'upload', 'pref'));
    }
}