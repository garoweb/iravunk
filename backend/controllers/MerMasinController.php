<?php

namespace backend\controllers;

use Yii;
use common\models\MerMasin;
use backend\models\SearchMerMasin;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MerMasinController implements the CRUD actions for MerMasin model.
 */
class MerMasinController extends Controller
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
     * Lists all MerMasin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchMerMasin();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MerMasin model.
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
     * Creates a new MerMasin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MerMasin();

        $loaded = $model->load(Yii::$app->request->post());
        if($loaded) {
            if(!$model->meta_key)
                $model->meta_key = $model->title;
            $model->user_id = Yii::$app->user->identity->id;
        }
        if ($loaded && $model->save()) {
            $model->upload();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $model->scenario = 'create';
        return $this->render('create', compact('model'));
    }

    /**
     * Updates an existing MerMasin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $loaded = $model->load(Yii::$app->request->post());
        if($loaded) {
            if(!$model->meta_key)
                $model->meta_key = $model->title;
        }

        if ($loaded && $model->save()) {
            $model->upload();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', compact('model'));
    }

    /**
     * Deletes an existing MerMasin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MerMasin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MerMasin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MerMasin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
