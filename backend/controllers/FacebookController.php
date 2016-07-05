<?php
namespace backend\controllers;

use Yii;
use backend\models\FacebookGroups;
use backend\models\FacebookUser;
use backend\models\FbUserCategories;
use yii\data\ActiveDataProvider;
use backend\controllers\MyAdminController;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\News;
use common\models\RuNews;



define('FACEBOOK_SDK_V4_SRC_DIR', '../../facebook-sdk-v5/');
require_once '../../facebook-sdk-v5/autoload.php';

class FacebookController extends MyAdminController
{

    public $app_id = '519557301557456';
    public $app_secret = '2dc42ad8378f9bb198dd46b0b6257de6';
    public $default_graph_version = 'v2.5';
    public $page_id = '114147762051065';
    public $base_url = 'http://iravunk.com';
    public function actionIndex()
    {
        $fb = new \Facebook\Facebook(array(
            'app_id' => $this->app_id,
            'app_secret' => $this->app_secret,
            'default_graph_version' => $this->default_graph_version,
        ));
        $helper = $fb->getRedirectLoginHelper();
        $permissions = array('publish_actions', 'manage_pages', 'publish_pages'); // optional
        $link = $helper->getLoginUrl('http://iravunk.com/admins/facebook/login', $permissions);
        echo '<p><a href="'.$link.'" class="btn btn-primary btn-xl page-scroll">Post To Facebook</a></p>';
    }

    public function actionLogin()
    {
        $fb = new \Facebook\Facebook(array(
            'app_id' => $this->app_id,
            'app_secret' => $this->app_secret,
            'default_graph_version' => $this->default_graph_version,
        ));

        $helper = $fb->getRedirectLoginHelper();
        try {
            $accessToken = $helper->getAccessToken();
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }


        if($accessToken) {

            $accessToken = $accessToken->getValue();
            $fUser = FacebookUser::findOne(['id' => 1]);
            try {
                // Returns a `Facebook\FacebookResponse` object
                $response = $fb->get('/me?fields=accounts,id,name', $accessToken);
            } catch(\Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }

            $user = $response->getGraphUser();
            $fUser = FacebookUser::findOne(['fb_id' => $user['id']]);
            if(!$fUser) {
                $fUser = new FacebookUser();
            }
            $fUser->fb_id = $user['id'];
            $fUser->name = $user['name'];
            $fUser->user_token = $accessToken;
			
			if($fUser->id == 1) {
				foreach($user['accounts'] as $page) {
                if($page['id'] == $this->page_id) {
                    $fUser->page_token = $page['access_token'];
                    if($fUser->save(false)) {
                        return $this->redirect('/admins');
                    } else {
                        print_r($fUser->getErrors());
                        die;
                    }
                    break;
                }
            }
            die('no page access');
			}
			
            if($fUser->save(false)) {
				return $this->redirect('/admins');
			} else {
				print_r($fUser->getErrors());
				die;
			}
        }
    }
	
	public function actionTest() {
		$fb = new \Facebook\Facebook(array(
                'app_id' => $this->app_id,
                'app_secret' => $this->app_secret,
                'default_graph_version' => $this->default_graph_version,
            ));
			
		$fbUser = FacebookUser::findOne(['id' => 10]);
		$news = News::find()->where(['id' => 1261])->one();
		
		$linkData = [
			'description' => 'iravunk.com '.$news::cut_title($news->content, 150),
			'name' => $news->title,
			'picture' => 'http://iravunk.com/uploads/'.$news->id.'.png',
			'link' => 'http://iravunk.com/news/1261',
		];
		$response = $fb->post('/me/feed', $linkData, $fbUser->user_token);
	}

    public function actionShareNews($id='')
    {
        set_time_limit(0);
        if($id && $news = News::find()->where(['id' => $id])->one()) {
            $fb = new \Facebook\Facebook(array(
                'app_id' => $this->app_id,
                'app_secret' => $this->app_secret,
                'default_graph_version' => $this->default_graph_version,
            ));
            $linkData = [
				'description' => $news::cut_title($news->content, 150),
				'name' => $news->title,
				'picture' => $this->base_url.'/uploads/'.$news->id.'.png',
                'link' => $this->base_url.'/news/'.$news->id,
            ];
            echo '
            <table class="table table-bordered">
                <tr>
                    <th>User</th>
                    <th>Խումբ</th>
                    <th>Կարգավիճակ</th>
                    <th>Պատասխան</th>
                </tr>
            ';

            $fbUser = FacebookUser::findOne(['id' => 1]);
            echo '<tr><td>',$fbUser->name,'</td><td>Իրավունք Էջ</td>';

            try {
                // Returns a `Facebook\FacebookResponse` object
                $response = $fb->post('/'.$this->page_id.'/feed', $linkData, $fbUser->page_token);
                sleep(2);
            } catch(\Facebook\Exceptions\FacebookResponseException $e) {
                echo '<td>Անհաջող</td><td>Facebook Graph returned an error: ' . $e->getMessage(),'</td></tr></table>';
                exit;
            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                echo '<td>Անհաջող</td><td>Facebook SDK returned an error: ' . $e->getMessage(),'</td></tr></table>';
                exit;
            }
            echo '<td>Հաջողված</td><td></td></tr>';
			
            foreach($news->categoryRelations as $categoryRel) {
                $groups = FacebookGroups::find()->where(['category_id' => $categoryRel->category_id])->all();
				$fb_user_id = FbUserCategories::find()->where(['category_id' => $categoryRel->category_id])->one();
				if($fb_user_id) {
					$fbUser = FacebookUser::find()->where(['id' => $fb_user_id->user_id])->one();
					foreach($groups as $group) {
						
						echo '<tr><td>',$fbUser->name,'</td><td>',$group->name,' (',$group->group_id,')</td>';
						try {
							// Returns a `Facebook\FacebookResponse` object
							$response = $fb->post('/'.$group->group_id.'/feed', $linkData, $fbUser->user_token);
							sleep(2);
						} catch(\Facebook\Exceptions\FacebookResponseException $e) {
							echo '<td>Անհաջող</td><td>Facebook Graph returned an error: ' . $e->getMessage(),'</td></tr></table>';
							exit;
						} catch(\Facebook\Exceptions\FacebookSDKException $e) {
							echo '<td>Անհաջող</td><td>Facebook Graph returned an error: ' . $e->getMessage(),'</td></tr></table>';
							exit;
						}
						echo '<td>Հաջողված</td><td></td></tr>';
					}
				}
                
            }
            echo '</table>';
        }

    }
	public function actionRuShareNews($id='')
    {
        set_time_limit(0);
        if($id && $news = RuNews::find()->where(['id' => $id])->one()) {
            $fb = new \Facebook\Facebook(array(
                'app_id' => $this->app_id,
                'app_secret' => $this->app_secret,
                'default_graph_version' => $this->default_graph_version,
            ));
            $linkData = [
				'description' => $news::cut_title($news->content, 150),
				'name' => $news->title,
				'picture' => $this->base_url.'/ru_uploads/'.$news->id.'.png',
                'link' => $this->base_url.'/ru/news/'.$news->id,
            ];
            echo '
            <table class="table table-bordered">
                <tr>
                    <th>User</th>
                    <th>Խումբ</th>
                    <th>Կարգավիճակ</th>
                    <th>Պատասխան</th>
                </tr>
            ';

            $fbUser = FacebookUser::findOne(['id' => 1]);
            echo '<tr><td>',$fbUser->name,'</td><td>Իրավունք Էջ</td>';

            try {
                // Returns a `Facebook\FacebookResponse` object
                $response = $fb->post('/'.$this->page_id.'/feed', $linkData, $fbUser->page_token);
                sleep(2);
            } catch(\Facebook\Exceptions\FacebookResponseException $e) {
                echo '<td>Անհաջող</td><td>Facebook Graph returned an error: ' . $e->getMessage(),'</td></tr></table>';
                exit;
            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                echo '<td>Անհաջող</td><td>Facebook SDK returned an error: ' . $e->getMessage(),'</td></tr></table>';
                exit;
            }
            echo '<td>Հաջողված</td><td></td></tr>';
           // foreach($news->categoryRelations as $categoryRel) {
				$category_id = 0;
                $groups = FacebookGroups::find()->where(['category_id' => $category_id])->all();
                $fbUser = FacebookUser::find()->where(['id' => 11])->one();
                foreach($groups as $group) {
                    echo '<tr><td>',$fbUser->name,'</td><td>',$group->name,' (',$group->group_id,')</td>';
                    try {
                        // Returns a `Facebook\FacebookResponse` object
                        $response = $fb->post('/'.$group->group_id.'/feed', $linkData, $fbUser->user_token);
                        sleep(2);
                    } catch(\Facebook\Exceptions\FacebookResponseException $e) {
                        echo '<td>Անհաջող</td><td>Facebook Graph returned an error: ' . $e->getMessage(),'</td></tr></table>';
                        exit;
                    } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                        echo '<td>Անհաջող</td><td>Facebook Graph returned an error: ' . $e->getMessage(),'</td></tr></table>';
                        exit;
                    }
                    echo '<td>Հաջողված</td><td></td></tr>';
                }
        //    }
            echo '</table>';
        }

    }
    
    public function actionShare($url='')
    {
		die;
		
        if($url) {
            $fb = new \Facebook\Facebook(array(
                'app_id' => $this->app_id,
                'app_secret' => $this->app_secret,
                'default_graph_version' => $this->default_graph_version,
            ));
            $linkData = [
                'link' => $url,
            ];

            $fbUser = FacebookUser::findOne(['id' => 1]);
            
            try {
                // Returns a `Facebook\FacebookResponse` object
                $response = $fb->post('/'.$this->page_id.'/feed', $linkData, $fbUser->page_token);
                sleep(2);
            } catch(\Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage(), '<br> page error';
                exit;
            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }

            $groups = FacebookGroups::find()->all();
            foreach($groups as $group) {
                try {
                    // Returns a `Facebook\FacebookResponse` object
                    $response = $fb->post('/'.$group->group_id.'/feed', $linkData, $fbUser->user_token);
                    sleep(2);
                } catch(\Facebook\Exceptions\FacebookResponseException $e) {
                    echo 'Graph returned an error: ' . $e->getMessage(),'<br>', 'group id: ', $group->group_id;
                    exit;
                } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                    echo 'Facebook SDK returned an error: ' . $e->getMessage();
                    exit;
                }
            }
            return $this->redirect('/admins');
        }
        return $this->render('share');
    }


}
