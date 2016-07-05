<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\models\News;

class RelatedPost extends Widget
{
	public $news_id;

	public function run()
	{
		$news = News::find()->select('meta_key, id')->where(['id' => $this->news_id])->one();
		$newses = News::find()  ->select("*, MATCH(meta_key) AGAINST('".$news->meta_key."') AS score")
								->where("MATCH(meta_key) AGAINST('".$news->meta_key."')")
								->andWhere(['is_published' => 1])
								->andWhere('id!='.$news->id)
                                ->orderBy('id DESC')
                                ->limit(3)
								->all();
		$view = $this->render('RelatedPost', compact('newses', 'newses'));
		return $view;
	}
}