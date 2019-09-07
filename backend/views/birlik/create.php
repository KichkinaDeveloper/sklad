<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Birlik */

$this->title = 'Birlik yaratish';
$this->params['breadcrumbs'][] = ['label' => 'Birliks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="birlik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
