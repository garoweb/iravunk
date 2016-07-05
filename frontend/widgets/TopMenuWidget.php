<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\models\Category;
use common\models\RuCategory;
use common\models\Page;
use common\models\RuPages;
use common\models\SimPages;
use common\models\SimCategories;

class TopMenuWidget extends Widget
{
	public $current;
    public $lang;
    public function run()
    {
        switch($this->lang) {
            case 'ru':
                $categories = RuCategory::find()->all();
                $pages = RuPages::find()->select(['id', 'title'])->all();
                $view = $this->render('RuTopMenu', compact('categories', 'pages'));
            break;
            case 'sim':
                $categories = SimCategories::find()->all();
                $pages = SimPages::find()->select(['id', 'title'])->all();
                $view = $this->render('SimTopMenu', compact('categories', 'pages'));
            break;
            default:
				if(strpos($this->current, 'page') || strpos($this->current, 'mermasin') ) {
					$mermasin = true;
				}
                $categories = Category::find()->all();
                $pages = Page::find()->select(['id', 'title'])->all();
                $view = $this->render('TopMenu', compact('categories', 'pages', 'mermasin'));
            break;
        }

        return $view;
    }
}