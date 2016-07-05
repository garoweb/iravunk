<?php

namespace backend\controllers;

use Yii;
use common\models\Category;
use common\models\News;
use common\models\CategoryRelations;
use common\models\NewsSearch;
use yii\web\NotFoundHttpException;
use yii\web\NotAcceptableHttpException;
/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends MyAdminController
{


	/**
	 * Lists all News models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new NewsSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single News model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new News model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new News();
		$loaded = $model->load(Yii::$app->request->post());
		if($loaded) {
			if($model->is_published)
				$model->published = date('Y-m-d H:i:s');
			if(!$model->meta_key)
				$model->meta_key = $model->title;
            $model->user_id = Yii::$app->user->identity->id;
		}
		if ($loaded && $model->save()) {
			$model->upload();
			$category_relations = $_POST['News']['categories'];
            if($category_relations) {
                foreach($category_relations as $cat_id) {
                    $category_relation = new CategoryRelations();
                    $category_relation->news_id = $model->id;
                    $category_relation->category_id = $cat_id;
                    $category_relation->save();
                }
            }
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			//throw new NotAcceptableHttpException('Access Denied!');
			$categories_arr = Category::find()->asArray()->all();
			$categories = [];
			foreach($categories_arr as &$cat) {
				$categories[$cat['id']] = $cat['title'];
			}
			$model->scenario = 'create';
			$model->is_published = 1;
			return $this->render('create', compact('model', 'categories'));
		}
	}

	/**
	 * Updates an existing News model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		$loaded = $model->load(Yii::$app->request->post());
		if($loaded) {
			if($model->is_published && !$model->published)
				$model->published = date('Y-m-d H:i:s');
		}

		if ($loaded && $model->save()) {
			$model->upload();
			$category_relations = $_POST['News']['categories'];
			CategoryRelations::deleteAll(['news_id' => $model->id]);
            if($category_relations) {
                foreach($category_relations as $cat_id) {
                    $category_relation = new CategoryRelations();
                    $category_relation->news_id = $model->id;
                    $category_relation->category_id = $cat_id;
                    $category_relation->save();
                }
            }
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			$categories_arr = Category::find()->asArray()->all();
            $categories = [];
			foreach($categories_arr as &$cat) {
				$categories[$cat['id']] = $cat['title'];
			}
			foreach($model->categoryRelations as $rel) {
				$model->categories[] = $rel->category_id;
			}
			return $this->render('update', compact('model', 'categories'));
		}
	}

	/**
	 * Deletes an existing News model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();
		$path = Yii::getAlias('@frontend') .'/web/uploads/';
		unlink($path.$id.'.png');
		return $this->redirect(['index']);
	}

	/**
	 * Finds the News model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return News the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = News::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
