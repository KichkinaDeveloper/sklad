<?php

namespace backend\controllers;

use Yii;
use common\models\Birlik;
use common\models\BirlikSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BirlikController implements the CRUD actions for Birlik model.
 */
class BirlikController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Birlik models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('admin')){
            $searchModel = new BirlikSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        else{
            throw new NotFoundHttpException("Sahifa topilmadi");
        }
    }

    public function actionLists($id)
    {
        $countBranches = Birlik::find()
            ->where(['cat_id'=>$id])
            ->count();

        $branches = Birlik::find()
            ->where(['cat_id'=>$id])
            ->all();
        
        if ($countBranches > 0) {
            foreach ($branches as $branch) {
                echo "<option value='".$branch->cat_id."''>".$branch->nomi."</option>";
            }
        }else if($countBranches == 0){
            echo "<option value='0'>-</option>";
        }
    } 

    /**
     * Displays a single Birlik model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('admin')){
            return $this->render('view', [
                'model' => $this->findModel($id),
                ]);
        }
        else{
            throw new NotFoundHttpException("Sahifa topilmadi");
        }
    }

    /**
     * Creates a new Birlik model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('admin')){
            
            $model = new Birlik();
    
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        else{
            throw new NotFoundHttpException("Sahifa topilmadi");
   
        }
    }

    /**
     * Updates an existing Birlik model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('admin')){

            $model = $this->findModel($id);
    
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
    
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        else{
            throw new NotFoundHttpException("Sahifa topilmadi");
        }
    }

    /**
     * Deletes an existing Birlik model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('admin')){
            
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }
        else{
            throw new NotFoundHttpException("Sahifa topilmadi");
        }
    }

    /**
     * Finds the Birlik model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Birlik the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Birlik::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
