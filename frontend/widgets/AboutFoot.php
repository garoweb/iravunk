<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\models\Page;
use common\models\RuPages;

class AboutFoot extends Widget
{
    public $lang;
    public function run()
    {
        switch($this->lang) {
            case 'ru':
                $about = 'О Нас';
                $pref = '/ru/';
                $oldSites = 'Старые Сайты';
                $pages = RuPages::find()->all();
            break;
            default:
                $about = 'Մեր Մասին';
                $pref = '';
                $oldSites = 'Հին Կայքերը';
                $pages = Page::find()->all();
            break;
        }
        return $this->render('AboutFoot', compact('pages', 'about', 'pref', 'oldSites'));
    }
}