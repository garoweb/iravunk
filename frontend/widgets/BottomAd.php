<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\models\Banner;
use common\models\RuBanners;

class BottomAd extends Widget
{
	public $id;
	public $lang;
	public function run()
	{
		switch($this->lang) {
			case 'ru':
				$banner = RuBanners::find()->where(['id' => $this->id])->one();
				$pref = 'ru_';
			break;
			default:
				$pref = '';
				$banner = Banner::find()->where(['id' => $this->id])->one();
			break;
		}

		return $this->render('BottomAd', compact('banner', 'pref'));
	}
}