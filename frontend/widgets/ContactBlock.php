<?php

namespace frontend\widgets;

use yii\base\Widget;

class ContactBlock extends Widget
{
    public $cat_id;
    public $title;
    public function run()
    {
        $view = $this->render('ContactBlock', compact('newses', 'title', 'id'));
        return $view;
    }
}