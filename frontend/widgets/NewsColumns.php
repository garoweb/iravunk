<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\models\Category;
use common\models\CategoryRelations;
use common\models\RuCategory;
use common\models\RuCategoryRelations;
use common\models\SimCategoryRelations;
use common\models\RuSimCategoryRelations;
use common\models\SimCategories;
use common\models\RuSimCategories;


class NewsColumns extends Widget
{
	public $cat_id;
	public $lang;
	public function run()
	{

		switch($this->lang) {
			case 'ru':
				$upload = 'ru_';
				$pref = '/ru/';
				$category = RuCategory::find()->where(['id' => $this->cat_id])->one();
				if($category) {
					$newses = RuCategoryRelations::find()->where(['category_id' => $this->cat_id, 'is_published' => 1])->addOrderBy('id DESC')->limit(12)->innerJoinWith('news')->all();
				}
			break;
            case 'sim':
				$upload = 'sim_';
				$pref = '/sim/';
				$category = SimCategories::find()->where(['id' => $this->cat_id])->one();
				if($category) {
					$newses = SimCategoryRelations::find()->where(['category_id' => $this->cat_id, 'is_published' => 1])->addOrderBy('id DESC')->limit(12)->innerJoinWith('news')->all();
				}
			break;
			default:
				$upload = '';
				$pref = '';
				$category = Category::find()->where(['id' => $this->cat_id])->one();
				if($category) {
					$newses = CategoryRelations::find()->where(['category_id' => $this->cat_id, 'is_published' => 1])->addOrderBy('id DESC')->limit(12)->innerJoinWith('news')->all();
				}
			break;
		}

		return $this->render('NewsColumns', compact('newses', 'category', 'upload', 'pref'));
	}
}