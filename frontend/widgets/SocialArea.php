<?php

namespace frontend\widgets;

use yii\base\Widget;
class SocialArea extends Widget
{

    public function run()
    {
        $view = $this->render('SocialArea');
        return $view;
    }
}