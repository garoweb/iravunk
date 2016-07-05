<?php

namespace frontend\widgets;

use yii\base\Widget;


class RightContent extends Widget
{

    public $lang;
    public $is_index;
    public function run()
    {
        switch($this->lang) {
            case 'ru':
                if($this->is_index) {
                    $view = '
                    <aside class="right_content">'.
                        RightTabs::widget(['lang' => 'ru']).
                        '<div class="col-md-12"><br /><br /></div>'.
                        RightAd::widget(['id' => 3, 'lang' => 'ru']).
                        '<div class="col-md-12" style="margin-top:19px"><br /><br /></div>'.
                        RightAd::widget(['id' => 4, 'lang' => 'ru']).
						'<style>#cat_23{margin-top:26px;}</style>'.
                        Calendar::widget(['cat_id' => 10, 'title' => 'КАЛЕНДАРЬ', 'lang'=> 'ru']).
                        RightAd::widget(['id' => 5, 'lang' => 'ru']).
                        PopularNews::widget(['lang' => 'ru']).
                        RightAd::widget(['id' => 6, 'lang' => 'ru']).
                        RightAd::widget(['id' => 7, 'lang' => 'ru']).
                        Archive::widget(['lang' => 'ru']).
                        Rate::widget().
                        GetPolls::widget(['lang' => 'ru']).'
                    </aside>
                ';
                } else {
                    $view = '
                    <aside class="right_content">'.
                        RightLatestNews::widget(['lang' => 'ru']).
                        RightAd::widget(['id' => 2]).
                        RightAd::widget(['id' => 5]).
                        RightAd::widget(['id' => 6]).
                        RightAd::widget(['id' => 7]).
                        RightAd::widget(['id' => 8]).
                        RightAd::widget(['id' => 10]).
                        RightAd::widget(['id' => 9]).
                        RightAd::widget(['id' => 11]).
                        RightAd::widget(['id' => 12]).
                        RightAd::widget(['id' => 13]).
                        RightAd::widget(['id' => 14]).
                        RightAd::widget(['id' => 15]).
                        RightAd::widget(['id' => 16]).'
                    </aside>
                ';
                }
            break;
            case 'sim':
                if($this->is_index) {
                    $view = '
                    <aside class="right_content">'.
                        RightTabs::widget(['lang' => 'sim']).
                        '<div class="col-md-12"><br /><br /></div>'.
                        RightAd::widget(['id' => 2]).
                        '<div class="col-md-12" style="margin-top:19px"><br /><br /></div>'.
                        RightAd::widget(['id' => 5]).
                        '<div class="col-md-12"></div>'.
                        Calendar::widget(['cat_id' => 23, 'title' => 'Օրացույց']).
                        RightAd::widget(['id' => 6]).
                        PopularNews::widget(['lang' => 'sim']).
                        RightAd::widget(['id' => 7]).
                        RightAd::widget(['id' => 8]).
                        '<div class="col-md-12" style="margin-top:12px"></div>'.
                        Archive::widget(['lang' => 'sim']).
                        '<div class="col-md-12" style="margin-top:80px"></div>'.
                        RightAd::widget(['id' => 10]).
                        '<div class="col-md-12" style="margin-top:82px"></div>'.
                        RightAd::widget(['id' => 9]).
                        RightAd::widget(['id' => 11]).
                        '<div class="col-md-12" style="margin-top:10px"></div>'.
                        Rate::widget().
                        RightAd::widget(['id' => 12]).
                        RightAd::widget(['id' => 13]).
                        RightAd::widget(['id' => 14]).
                        RightAd::widget(['id' => 15]).
                        RightAd::widget(['id' => 16]).'
                    </aside>
                ';
                } else {
                    $view = '
                    <aside class="right_content">'.
                        RightLatestNews::widget(['lang' => 'sim']).
                        RightAd::widget(['id' => 2]).
                        RightAd::widget(['id' => 5]).
                        RightAd::widget(['id' => 6]).
                        RightAd::widget(['id' => 7]).
                        RightAd::widget(['id' => 8]).
                        RightAd::widget(['id' => 10]).
                        RightAd::widget(['id' => 9]).
                        RightAd::widget(['id' => 11]).
                        RightAd::widget(['id' => 12]).
                        RightAd::widget(['id' => 13]).
                        RightAd::widget(['id' => 14]).
                        RightAd::widget(['id' => 15]).
                        RightAd::widget(['id' => 16]).'
                    </aside>
                ';
                }
            break;
            default:
                if($this->is_index) {
                    $view = '
                    <aside class="right_content">'.
                        RightTabs::widget().
                        '<div class="col-md-12"><br /><br /></div>'.
                        RightAd::widget(['id' => 2]).
                        '<div class="col-md-12" style="margin-top:19px"><br /><br /></div>'.
                        RightAd::widget(['id' => 5]).
                        '<div class="col-md-12"></div>'.
                        Calendar::widget(['cat_id' => 23, 'title' => 'Օրացույց']).
                        RightAd::widget(['id' => 6]).
                        PopularNews::widget().
                        RightAd::widget(['id' => 7]).
                        RightAd::widget(['id' => 8]).
                        '<div class="col-md-12" style="margin-top:12px"></div>'.
                        Archive::widget().
                        '<div class="col-md-12" style="margin-top:80px"></div>'.
                        RightAd::widget(['id' => 10]).
                        '<div class="col-md-12" style="margin-top:82px"></div>'.
                        RightAd::widget(['id' => 9]).
                        RightAd::widget(['id' => 11]).
                        '<div class="col-md-12" style="margin-top:10px"></div>'.
                        Rate::widget().
                        RightAd::widget(['id' => 12]).
                        RightAd::widget(['id' => 13]).
                        RightAd::widget(['id' => 14]).
                        GetPolls::widget().
                        RightAd::widget(['id' => 15]).
                        RightAd::widget(['id' => 16]).
						//RightAd::widget(['id' => 17]).
						RightAd::widget(['id' => 18]).'
                    </aside>
                ';
                } else {
                    $view = '
                    <aside class="right_content">'.
                        RightLatestNews::widget().
                        RightAd::widget(['id' => 2]).
                        RightAd::widget(['id' => 5]).
                        RightAd::widget(['id' => 6]).
                        RightAd::widget(['id' => 7]).
                        RightAd::widget(['id' => 8]).
                        RightAd::widget(['id' => 10]).
                        RightAd::widget(['id' => 9]).
                        RightAd::widget(['id' => 11]).
                        RightAd::widget(['id' => 12]).
                        RightAd::widget(['id' => 13]).
                        RightAd::widget(['id' => 14]).
                        RightAd::widget(['id' => 15]).
                        RightAd::widget(['id' => 16]).'
                    </aside>
                ';
                }

            break;
        }

        return $view;
    }
}