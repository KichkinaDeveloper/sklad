<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card mx-auto" style="width:350px; margin-top:60px; height:500px;">

  <h5 class="card-header primary-color white-text text-center py-4">
    <strong>SignUp</strong>
  </h5>

  <div class="card-body px-lg-5 pt-0">

    <!-- Form -->
    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
    <form class="text-center" style="color: #757575;">

      <!-- Email -->
      <div class="md-form pt-2">
        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
      </div>

      <!-- Password -->
      <div class="md-form">
        <?= $form->field($model, 'password')->passwordInput() ?>
      </div>

      <div class="md-form" style="margin-left:-30px">
      <?= $form->field($model, 'reCaptcha')->label(false)->widget(
    \himiklab\yii2\recaptcha\ReCaptcha2::className(),
    [
        'siteKey' => '6LcQX6wUAAAAADSxnujxROzrwp6utaV6QFbfDhy-',
         // unnecessary is reCaptcha component was set up
    ]) ?>
    </div>
      <!-- Sign in button -->
      <div class="form-group">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0', 'name' => 'signup-button']) ?>
        </div>
      <!-- Register -->
    </form>
    <?php ActiveForm::end(); ?>
    <!-- Form -->
  </div>
</div>