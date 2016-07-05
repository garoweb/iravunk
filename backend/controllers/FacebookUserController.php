<?php

namespace backend\controllers;

use Yii;
use backend\models\FacebookUser;
use backend\models\FbUserCategories;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FacebookUserController implements the CRUD actions for FacebookUser model.
 */
class FacebookUserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all FacebookUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => FacebookUser::find()->where('id>1'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FacebookUser model.
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
     * Updates an existing FacebookUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			FbUserCategories::deleteAll(['user_id' => $model->id]);
			$model->categories = $_POST['FacebookUser']['categories'];
			foreach($model->categories as $cat_id) {
				$userCategory = new FbUserCategories();
				$userCategory->user_id = $id;
				$userCategory->category_id = $cat_id;
				$userCategory->save();
			}
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
			$categories = FbUserCategories::find()->where(['user_id' => $id])->all();
			foreach($categories as $category) {
				$model->categories[] = $category->category_id;
			}
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FacebookUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($id == 1) {
            die('no access to id 1');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FacebookUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FacebookUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FacebookUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
