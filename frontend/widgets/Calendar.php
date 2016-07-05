<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\models\CategoryRelations;
use common\models\RuCategoryRelations;

class Calendar extends Widget
{
    public $lang;
    public $cat_id;
    public $title;
    public function run()
    {
        switch($this->lang) {
            case 'ru':
				$news = RuCategoryRelations::find()->where(['category_id' => $this->cat_id, 'is_published' =>1])->innerJoinWith('news')->addOrderBy('id DESC')->limit(1)->one();
            break;
            default:
                $news = CategoryRelations::find()->where(['category_id' => $this->cat_id, 'is_published' =>1])->innerJoinWith('news')->addOrderBy('id DESC')->limit(1)->one();
            break;
        }
        $title = $this->title;
        $id = $this->cat_id;
        return $this->render('Calendar', compact('news', 'title', 'id'));
    }
}