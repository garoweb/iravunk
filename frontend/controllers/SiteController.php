<?php
namespace frontend\controllers;

use common\models\Category;
use common\models\CategoryRelations;
use common\models\MerMasin;
use common\models\News;
use common\models\Page;
use common\models\Polls;
use common\models\PollsAnswers;
use common\models\PollsUserAnswers;
use common\models\Video;
use Yii;
use frontend\models\ContactForm;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;

/**
 * Site controller
 */
class SiteController extends Controller
{



	/**
	 * Displays homepage.
	 *
	 * @return mixed
	 */
	public function actionIndex()
	{
        $categories = Category::find()->where('id > 1')->andWhere(['type' => 0])->orderBy('sort')->all();
        $bigCategories = Category::find()->where('id > 1')->andWhere(['type' => 1])->all();
		return $this->render('index', compact('categories', 'bigCategories'));
	}

	/**
	 * Displays newspage.
	 *
	 * @return mixed
	 */
	public function actionNews($id)
	{
        $news = News::find()->where(['id' => $id, 'is_published' => 1])->one();
        if(!$news) {
            throw new \yii\web\NotFoundHttpException();
        }
        $categories = [];
        foreach($news->categoryRelations as $category) {
            $categories[] = $category->category_id;
        }
        $news->categories = Category::find()->where(['id' => $categories])->all();
        $news->hits++;
        $news->save();
        if($id > 1) {
            $previous_news = News::find()->where(['is_published' => 1])->andWhere('id<'.$id)->limit(1)->one();
        }
        $next_news = News::find()->where(['is_published' => 1])->andWhere('id>'.$id)->limit(1)->one();
		return $this->render('news', compact('news', 'previous_news', 'next_news'));
	}

    public function actionCategory($id)
	{
        if($id) {
            $category = Category::find()->where(['id' => $id])->one();
            if(!$category) {
                throw new \yii\web\NotFoundHttpException();
            }
            $query = CategoryRelations::find()->where(['category_id'=> $category->id, '{{%news}}.is_published' => 1])->orderBy('{{%news}}.id DESC')->innerJoinWith('news');
        } else {
            $category = new Category();
            if(isset($_GET['date'])) {
                $date = $_GET['date'];
                $date = date('Y-m-d', strtotime($date));
                if($date != '1970-01-01') {
                    $category->title = 'Լուրեր '.date('d.m.Y', strtotime($date));
                    $query = News::find()->where(['is_published' => 1])->andWhere('created LIKE "'.$date.'%"')->orderBy('id DESC');
                } else {
                    return $this->redirect('category', 302);
                }
            } elseif(isset($_GET['search'])) {
                $search = $_GET['search'];
                $category->title = 'Որոնում `'.$search;
                $query = News::find()->where(['is_published' => 1])
                            ->andFilterWhere([
                                'or',
                                ['like', 'title', $search],
                                ['like', 'content', $search],
                                ['like', 'meta_key', $search]
                            ])
                            ->orderBy('id DESC');
            } else {
                $category->title = 'Լուրեր';
                $query = News::find()->where(['is_published' => 1, 'place' => 2])->orWhere(['is_published' => 1, 'place' => 3])->orderBy('id DESC');
            }

        }
        $pages = new Pagination(['totalCount' => $query->count()]);
        $newses = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
		return $this->render('category', compact('newses', 'category', 'pages'));
	}

    public function actionPage($id)
    {
        $page = Page::find()->where(['id' => $id])->one();
        if(!$page) {
            throw new \yii\web\NotFoundHttpException();
        }
		$active = 'mer_masin';
        return $this->render('page', compact('page', 'active'));
    }

    public function actionVideo()
    {
        $query = Video::find()->orderBy('id DESC');
        $pages = new Pagination(['totalCount' => $query->count()]);
        $videos = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('video', compact('videos', 'pages'));
    }

    public function actionMermasin($type=1)
    {
        $rightNewses = MerMasin::find()->where(['type' => 0])->orWhere(['type' => 2])->orderBy('id DESC')->all();
        $query = MerMasin::find()->where(['type' => 1])->orWhere(['type' => 2])->orderBy('id DESC');
        $pages = new Pagination(['totalCount' => $query->count()]);
        $leftNewses = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('mermasin', compact('leftNewses', 'pages', 'rightNewses'));
    }


    public function actionMermasinNews($id)
    {
        $rightNewses = MerMasin::find()->where(['type' => 0])->orWhere(['type' => 2])->orderBy('id DESC')->all();
        $news = MerMasin::find()->where(['id' => $id])->one();
        if(!$news) {
            throw new \yii\web\NotFoundHttpException();
        }
        $news->hits++;
        $news->save();
        return $this->render('mermasin-news', compact('news', 'rightNewses'));
    }

    public function actionPollAnswer()
    {
        $model = new PollsUserAnswers();
        if ($model->load(Yii::$app->request->post())) {
            $getCookies = \Yii::$app->request->cookies;
            $userKey = $getCookies->getValue('user_key');
            if(!$userKey) {
                $userKey = md5(rand(1, 1000).time());
                $setCookies = \Yii::$app->response->cookies;
                $setCookies->add(new \yii\web\Cookie([
                    'name' => 'user_key',
                    'value' => $userKey,
                    'expire' => time() + 86400
                ]));
            } elseif(PollsUserAnswers::find()->where(['user_key' => $userKey, 'poll_id' => $model->poll_id])->limit(1)->one()) {
                //return false;
            }
            $model->user_key = $userKey;
            if($model->save()) {
                return json_encode($this->actionShowAnswers($model->poll_id));
            }
        }
    }

    public function actionShowAnswers($poll_id=0)
    {
        $poll = Polls::findOne(['id' => $poll_id]);
        return $poll->getAnswersStat();
    }

	/**
	 * Displays contact page.
	 *
	 * @return mixed
	 */
	public function actionContact()
	{
		$model = new ContactForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
				Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
			} else {
				Yii::$app->session->setFlash('error', 'There was an error sending email.');
			}

			return $this->refresh();
		} else {
			return $this->render('contact', [
				'model' => $model,
			]);
		}
	}

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

}
