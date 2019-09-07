<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Kategory;
use common\models\Birlik;
use common\models\Product;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

<?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map(Kategory::find()->all(), 'id', 'name'),
        ['prompt' => '-Tanlash-',
        'onchange' => '
                $.post("index.php?r=birlik/lists&id='.'"+$(this).val(), function(data){
                    $("select#catid").html(data);
                });
                $.post("index.php?r=product/lists&id='.'"+$(this).val(), function(data){
                    $("select#cat_id").html(data);
                });
            ']
    ) ?>

    <?= $form->field($model, 'name')->dropDownList(
        ArrayHelper::map(Product::find()->all(), 'id', 'name'),
        [
            'prompt' => '-Mahsulot-',   
            'id' => 'cat_id',
        ])
    ?>

    <?= $form->field($model, 'birlik')->dropDownList(
        ArrayHelper::map(Birlik::find()->all(), 'id', 'nomi'),
        [
            'prompt' => '-Birlik-',
            'id' => 'catid',
        ])
    ?>

    <?= $form->field($model, 'count')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Sotish', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>