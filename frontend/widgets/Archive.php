<?php

namespace frontend\widgets;

use yii\base\Widget;
class Archive extends Widget
{
    public $lang;
    public function run()
    {
        switch($this->lang) {
            case 'ru':
                $name = 'Архив';
                $pref = '/ru/';
            break;
            case 'sim':
                $name = 'Արխիվ';
                $pref = '/sim/';
            break;
            default:
                $name = 'Արխիվ';
                $pref = '';
            break;
        }
        return $this->render('Archive', compact('name', 'pref'));
    }
}