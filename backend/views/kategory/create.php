<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Kategory */

$this->title = 'Create Kategory';
$this->params['breadcrumbs'][] = ['label' => 'Kategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
