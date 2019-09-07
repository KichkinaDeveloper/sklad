<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

<nav class="navbar navbar-expand-lg navbar-dark primary-color">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/site/index">Bosh sahifa<span class="sr-only">(current)</span></a>
      </li>
      <?php if(!\Yii::$app->user->isGuest):?>

<li class="nav-item">
    <a class="nav-link font-weight-bold text-white" data-method="POST" href="<?=\yii\helpers\Url::to(['/site/logout']) ?>">LogOut(<?=Yii::$app->user->identity->username?>)</a>
</li>

<?php else:?>

<li class="nav-item">
    <a class="nav-link" href="<?=\yii\helpers\Url::to(['/site/signup'])?>">SignUp</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="<?=\yii\helpers\Url::to(['/site/login'])?>">LogIn</a>
</li>
<?php endif?>
</ul>
  </div>
</nav>
    <div class="container">
        <?= $content ?>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
