<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\models\CategoryRelations;
use common\models\RuCategoryRelations;
use common\models\SimCategoryRelations;
use common\models\RuSimCategoryRelations;
class BigCategoryBlock extends Widget
{
    public $cat_id;
    public $title;
    public $lang;
    public function run()
    {
        switch($this->lang) {
            case 'ru':
                $news = RuCategoryRelations::find()->where(['category_id' => $this->cat_id, 'is_published' =>1])->innerJoinWith('news')->addOrderBy('id DESC')->limit(1)->one();
                $pref = '/ru/';
                $upload = 'ru_';
            break;
            case 'sim':
                $news = SimCategoryRelations::find()->where(['category_id' => $this->cat_id, 'is_published' =>1])->innerJoinWith('news')->addOrderBy('id DESC')->limit(1)->one();
                $pref = '/sim/';
                $upload = 'sim_';
            break;
            default:
                $news = CategoryRelations::find()->where(['category_id' => $this->cat_id, 'is_published' =>1])->innerJoinWith('news')->addOrderBy('id DESC')->limit(1)->one();
                $pref = '';
                $upload = '';
            break;
        }
        $title = $this->title;
        $id = $this->cat_id;
        return $this->render('BigCategoryBlock', compact('news', 'title', 'id', 'pref', 'upload'));
    }
}