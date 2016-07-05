<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\models\CategoryRelations;
use common\models\RuCategoryRelations;

class CategoryBlock extends Widget
{
    public $cat_id;
    public $title;
    public $lang;
    public function run()
    {
        switch($this->lang) {
            case 'ru':
                $pref = '/ru/';
                $upload = 'ru_';
                $newses = RuCategoryRelations::find()->where(['category_id' => $this->cat_id, 'is_published' =>1])->innerJoinWith('news')->addOrderBy('id DESC')->limit(4)->all();
            break;
            default:
                $pref = '';
                $upload = '';
                $newses = CategoryRelations::find()->where(['category_id' => $this->cat_id, 'is_published' =>1])->innerJoinWith('news')->addOrderBy('id DESC')->limit(4)->all();
            break;
        }
        $title = $this->title;
        $id = $this->cat_id;
        return $this->render('CategoryBlock', compact('newses', 'title', 'id', 'pref', 'upload'));
    }
}