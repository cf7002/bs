<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Tag;
use app\modules\admin\models\TagSearch;
use yii\web\NotFoundHttpException;

/**
 * TagController implements the CRUD actions for Tag model.
 */
class TagController extends CustomController
{
    /**
     * Lists all Tag models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TagSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tag model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tag model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tag();
        $model->loadDefaultValues();

        do {
            if (!Yii::$app->request->isPost) {
                break;
            }
            if (!$model->load(Yii::$app->request->post())) {
                break;
            }
            if (!$model->validate()) {
                Yii::$app->session->addFlash('error', Yii::t('app', 'Validation error'));
                break;
            }
            if (!$model->save(false)) {
                Yii::$app->session->addFlash('error', Yii::t('app', 'Error saving'));
                break;
            }
            return $this->redirect(['view', 'id' => $model->id]);

        } while (0);

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tag model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        do {
            if (!Yii::$app->request->isPost) {
                break;
            }
            if (!$model->load(Yii::$app->request->post())) {
                break;
            }
            if (!$model->validate()) {
                Yii::$app->session->addFlash('error', Yii::t('app', 'Validation error'));
                break;
            }

            if ($model->version != $model->oldAttributes['version']) {
                Yii::$app->session->addFlash('error', Yii::t('app', 'Data changed'));
                break;
            }
            $model->version += 1;

            if (!$model->save(false)) {
                Yii::$app->session->addFlash('error', Yii::t('app', 'Error saving'));
                break;
            }
            return $this->redirect(['view', 'id' => $model->id]);

        } while (0);

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tag model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Tag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tag::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
