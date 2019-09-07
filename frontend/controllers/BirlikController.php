<?php

namespace frontend\controllers;
use yii\web\Controller;
use common\models\Birlik;

class BirlikController extends Controller{
    
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
}
?>