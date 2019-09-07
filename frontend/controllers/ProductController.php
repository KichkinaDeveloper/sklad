<?php

namespace frontend\controllers;
// use vendor\PHPExcel\Classes\PHPExcel;
use yii\web\Controller;
use common\models\Product;
use common\models\User;
use yii\data\Pagination;
use yii2tech\spreadsheet\Spreadsheet;
use yii\data\ActiveDataProvider;
use yii\web\Session;
use Yii;
use common\models\Orders;
use yii\web\ForbiddenHttpException;
use PharIo\Manifest\Type;
use common\models\Birlik;
use yii\db\Query;

// use yii\web\User;

class ProductController extends Controller{

    public function actionIndex()
    {
        
            $model = new Product();
            $user = new User();
            $user1 = (int)$user;

            $model = $model->find()->where(['user_id' => Yii::$app->user->id]);

            //  $all = "SELECT product.name,product.count,birlik.nomi FROM `product`
            //   JOIN `kategory` on product.category_id = kategory.id
            //   JOIN `birlik` on kategory.id = birlik.cat_id where product.user_id = $user1";    

            $query = new Query;
            $query->select([
        'product.name AS pname', 
        'product.count as pcount',
        'product.maximal as maximal',
        'birlik.nomi as bnomi']
        )  
        ->from('product')
        ->join('INNER JOIN', 'kategory',
            'product.category_id = kategory.id')		
        ->join('INNER JOIN', 'birlik', 
            'kategory.id = birlik.cat_id')->where(["=", "product.user_id", "$user1"]); 
		
            
            $pagination = new Pagination ([
                'defaultPageSize' => 6,
                'totalCount' => $query
                ]);
                
                $query->limit($pagination->limit);
                $query->offset($pagination->offset);
                
                $command = $query->createCommand();
                $model = $command->queryAll();
                
            return $this->render ('index', [
                'all' => $model,
                'pagination' => $pagination,
            ]);
                
        }
            
            public function actionDecrease(){
                
                $sql="SELECT * FROM `product` WHERE count / maximal < 1/2";
                $query = Product::findBySql($sql);
                
                $pagination = new Pagination ([
                'defaultPageSize' => 6,
                'totalCount' => $query->count()
            ]);
            
            $query->limit($pagination->limit);
            $query->offset($pagination->offset);
            
            return $this->render('decrease', [
                'query' => $query->all(),
                'pagination' => $pagination
        ]);
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
    
    public function actionExport(){
        if(isset($_POST['first']) && isset($_POST['last'])){
            $a = $_POST['first'];
            $b = $_POST['last'];
            
        if(isset($_POST['sel'])){
            $select1 = $_POST['sel'];
                switch ($select1) {
                case '1':
                $tanlov = 1;
                    break;
                case '2':
                    $tanlov = 2;
                    break;
                case '3':
                    $tanlov = 3;
                    break;
                default:
                    echo "akaye bu bo'ganku axir!";
                    break;
    }
        }
            else{
                 throw new ForbiddenHttpException("Kechirasiz ma'lumotlarni excelga export qilishda xatolik bo'ldi.Qaytadan urinib ko'ring!");
        }
            
            if($tanlov == 1){
                $rows = (new \yii\db\Query())
                ->select(['count AS `Mahsulot miqdori`', 'name AS `Mahsulot nomi`',
                'created_at AS `Sotilgan vaqti`', 'Xabar', 'Qoldi AS `Qolgan mahsulot`'])
                ->where([ '>','created_at',$a])
                ->andWhere(['<','created_at', $b])
                ->from('orders');
            }    
            else if($tanlov == 2){
                $rows = (new \yii\db\Query())
                ->select(['count AS `Mahsulot miqdori`', 'name AS `Mahsulot nomi`',
                'created_at AS `Qoshilgan vaqti`','qoshildi AS `Qo\'shilgan mahsulot miqdori`','message AS Xabar'])
                ->where([ '>','update_at',$a])
                ->andWhere(['<','update_at', $b])
                    ->from('product');
            }    
            else if($tanlov == 3){
                $bir = (new \yii\db\Query())
                ->select(['count AS `Sotilgan mahsulot miqdori`', 'name AS `Mahsulot nomi`',
                'created_at AS `Sotilgan vaqti`', 'Xabar', 'Qoldi AS `Qolgan mahsulot`'])
                ->where([ '>','created_at',$a])
                ->andWhere(['<','created_at', $b])
                ->from('orders');

                $rows = (new \yii\db\Query())
                ->select(['count AS `Yangilangan mahsulot miqdori`', 'name AS `Mahsulot nomi`',
                'created_at AS `Qoshilgan vaqti`','message AS Xabari', 'qoshildi AS `Qo\'shilgan mahsulot miqdori`'])
                ->where([ '>','update_at',$a])
                ->andWhere(['<','update_at', $b])
                    ->from('product');
                $rows->union($bir);
            }
            
            $exporter = new Spreadsheet([
                'dataProvider' => new ActiveDataProvider([
                    'query' => $rows,
                    ]),
                ]);
                    return $exporter->send('mahsulot.xls');
        }
            
                return $this->render("export");
    }

     public function actionSend()
    {
        $model = new Product();
        $order = new Orders();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model = Product::findOne($_POST['Product']['name']);
            
            $order->product_id = $model->id;
            $order->name = $model->name;

            $order->count = (int)$_POST['Product']['count'];
            $order->created_at = date("Y-m-d");

            if($model->count < (int)$_POST['Product']['count']){
                $model->save(false);
                throw new ForbiddenHttpException("Siz mahsulotni maksimal qiymatidan ko'p kiritdingiz!");
                return $this->redirect(['index']);
            }
            $model->count -= (int)$_POST['Product']['count'];
            $order->Qoldi = $model->count;
            $model->save();
            $order->save();
            
            if ($order->save() && $model->save())
                return $this->redirect(['index']);
    }       
        return $this->render('send', [
            'model' => $model,
            ]);
    }
     public function actionAdd()
    {
        $model = new Product();
  
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model = Product::findOne($_POST['Product']['name']);
            $a = $model->count;
            $model->count += (int)$_POST['Product']['count'];
            
            if($model->maximal < $model->count){
                $model->maximal = $model->count;
          }
            $model->update_at = date("Y-m-d");
            $model->message = "Qoshildi";
            
            $model->qoshildi = $model->count - $a;
            Yii::$app->session->setFlash('success', 'OKY');
            $model->save();

            if($model->save()){
                return $this->redirect("index");
            }
}
                return $this->render('add', [
            'model' => $model,
            ]);
}
}
?>