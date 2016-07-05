<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\models\Category;
use common\models\RuCategory;
use common\models\SimCategories;

class CategoryTag extends Widget
{
    public $lang;
    public function run()
    {
        switch($this->lang) {
            case 'ru':
                $name = 'Разделы';
                $categories = RuCategory::find()->all();
                $pref = '/ru/';
            break;
            case 'sim':
                $name = 'Բաժիններ';
                $categories = SimCategories::find()->all();
                $pref = '/sim/';
            break;
            default:
                $name = 'Բաժիններ';
                $categories = Category::find()->all();
                $pref = '';
            break;
        }
        return $this->render('CategoryTag', compact('categories', 'name', 'pref'));
    }
}