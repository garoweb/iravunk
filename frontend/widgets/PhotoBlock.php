<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\models\Photos;
use common\models\RuPhotos;
use common\models\SimPhotos;

class PhotoBlock extends Widget
{
    public $lang;
    public function run()
    {
        switch($this->lang) {
            case 'ru':
                $name = 'Фоторепортаж';
                $upload = 'ru_';
                $photos = RuPhotos::find()->orderBy('id DESC')->limit(6)->all();
            break;
            case 'sim':
                $name = 'Օրվա Ֆոտոռեպորտաժ';
                $upload = 'sim_';
                $photos = SimPhotos::find()->orderBy('id DESC')->limit(6)->all();
            break;
            default:
                $name = 'Օրվա Ֆոտոռեպորտաժ';
                $upload = '';
                $photos = Photos::find()->orderBy('id DESC')->limit(6)->all();
            break;
        }
        return $this->render('PhotoBlock', compact('photos', 'name', 'upload'));
    }
}