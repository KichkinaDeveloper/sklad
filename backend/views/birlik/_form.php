<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Kategory;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Birlik */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="birlik-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cat_id')->dropDownList(
        ArrayHelper::map(Kategory::find()->all(), 'id', 'name'),
        [
            'prompt' => '-Kategoriya-',
        ])
    ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
