<?php

namespace backend\controllers;

use Yii;
use common\models\Product;
use common\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Category;
use common\models\Ulchov;
use yii\web\ForbiddenHttpException;
use yii\helpers\Url;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('product-update')){
            $searchModel = new ProductSearch();
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
        $countProduct = Product::find()
            ->where(['category_id'=>$id])
            ->count();
        $products = Product::find()
            ->where(['category_id'=>$id])
            ->all();
        if ($countProduct > 0) {
            foreach ($products as $product) {
                echo "<option value='".$product->id."''>".$product->name."</option>";
            }
        }else{
            echo "<option value='0'>-</option>";
        }
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
        if(Yii::$app->user->can('admin')){
            $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->maximal = $model->count;
            $model->user_id = Yii::$app->user->id;
            $model->created_at = date("Y-m-d");
            $model->save();
                return $this->redirect(['index']);
    }
        else{
            if(Yii::$app->request->isAjax){
                return $this->renderAjax('create', [
                    'model' => $model,
                    ]);
                }
                return $this->render('create', [
                    'model' => $model,
                    ]);
                }
        }
        else{
            throw new ForbiddenHttpException("Siz mahsulot qo'sha olmaysiz!");
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('product-update')){
            $model = $this->findModel($id);
            $a = $model->count;
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                if($model->maximal < $model->count){
                    $model->maximal = $model->count;
              }
                $model->update_at = date("Y-m-d");
                $model->message = "Qoshildi";
                $model->qoshildi = $model->count - $a;
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
    
            }
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        else{
            throw new ForbiddenHttpException("Siz mahsulot qo'sha olmaysiz!");
        }
        
    }
    /**
     * Deletes an existing Product model.
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
            throw new ForbiddenHttpException("Siz mahsulot delete olmaysiz!");
        }


    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
