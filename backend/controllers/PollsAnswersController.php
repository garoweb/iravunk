<?php

namespace backend\controllers;

use Yii;
use common\models\PollsAnswers;
use common\models\Polls;
use backend\models\SearchPollsAnswers;
use yii\web\NotFoundHttpException;

/**
 * PollsAnswersController implements the CRUD actions for PollsAnswers model.
 */
class PollsAnswersController extends MyAdminController
{

    /**
     * Lists all PollsAnswers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchPollsAnswers();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PollsAnswers model.
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
     * Creates a new PollsAnswers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($poll_id)
    {
        $poll_id = abs((int)$poll_id);
        if(!$poll_id || !($poll = Polls::find()->where(['id' => $poll_id])->one())) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $model = new PollsAnswers();
        $model->poll_id = $poll_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PollsAnswers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PollsAnswers model.
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
     * Finds the PollsAnswers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PollsAnswers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PollsAnswers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
