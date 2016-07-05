<?php

namespace frontend\widgets;

use yii\base\Widget;

class SocialShare extends Widget
{
    public function run()
    {
        $view = $this->render('SocialShare');
        return $view;
    }
}