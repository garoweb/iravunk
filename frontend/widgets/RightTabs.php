<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\models\Video;
use common\models\RuVideo;
use common\models\SimVideos;

class RightTabs extends Widget
{
    public $lang;
    public function run()
    {
        switch($this->lang) {
            case 'ru':
                $name = 'Video';
                $videos = RuVideo::find()->orderBy('id DESC')->limit(5)->all();
            break;
            case 'sim':
                $name = 'Video';
                $videos = SimVideos::find()->orderBy('id DESC')->limit(5)->all();
            break;
            default:
                $name = 'Տեսանյութ';
                $videos = Video::find()->orderBy('id DESC')->limit(5)->all();
            break;
        }
        return $this->render('RightTabs', compact('videos', 'name'));
    }
}