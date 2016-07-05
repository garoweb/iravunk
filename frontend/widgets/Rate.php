<?php

namespace frontend\widgets;
use yii\base\Widget;
class Rate extends Widget
{

    public $name = 'Փոխարժեք';
    public function run()
    {
        $name = $this->name;
        $view = $this->render('Rate', compact('name'));
        return $view;
    }
}