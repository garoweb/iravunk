<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\models\Polls;
use common\models\PollsUserAnswers;
use common\models\RuPolls;
use common\models\RuPollsUserAnswers;
class GetPolls extends Widget
{
    public $lang;
    public function run()
    {
        $poll = null;
        $view = '';
        $getCookies = \Yii::$app->request->cookies;

        $userKey = $getCookies->getValue('user_key');
        switch($this->lang) {

            case 'ru':
                if(!$userKey) {
                    $polls = RuPolls::getForNewUser();
                } else {
                    $polls = RuPolls::getForOldUser($userKey);
                }

                if($polls) {
                    foreach($polls as $poll) {
                        $model = new RuPollsUserAnswers();
                        $view .= $this->render('RuGetPolls', compact('poll', 'model'));
                    }
                }
            break;

            default:
                if(!$userKey) {
                    $polls = Polls::getForNewUser();
                } else {
                    $polls = Polls::getForOldUser($userKey);
                }
                if($polls) {
                    foreach($polls as $poll) {
                        $model = new PollsUserAnswers();
                        $view .= $this->render('GetPolls', compact('poll', 'model'));
                    }
                }
            break;
        }

        return $view;
    }
}