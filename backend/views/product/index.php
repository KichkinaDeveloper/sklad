<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii2tech\spreadsheet\Spreadsheet;
use yii\data\ArrayDataProvider;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Mahsulot yaratish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php 
    //     Modal::begin([
    //         'header' => '<h4>Mahsulot yaratish</h4>',
    //         'id' => 'modal',
    //         'size' => 'modal-lg',
    //     ]);
    // echo "<div id='modalContent'></div>";
    // Modal::end();
    ?> 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php Pjax::begin(['id' => 'branchesGrid']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [   'label' => 'Kategorya nomi',
                'value' => 'kategory.name',
            ],
            'name',
            'count',
            [
            'label' => 'Birlik nomi',
            'value' => 'birlik'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>
