<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card mx-auto" style="width:350px; margin-top:85px; height:450px;">

  <h5 class="card-header info-color white-text text-center py-4">
    <strong>Login</strong>
  </h5>

  <div class="card-body px-lg-5 pt-0">

    <!-- Form -->
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <form class="text-center" style="color: #757575;">

      <!-- Email -->
      <div class="md-form pt-2">
      <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
      </div>

      <!-- Password -->
      <div class="md-form">
      <?= $form->field($model, 'password')->passwordInput() ?>
      </div>

      <!-- Sign in button -->
      <div class="form-group pt-2">
            <?= Html::submitButton('Login', ['class' => 'btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0', 'name' => 'login-button']) ?>
        </div>
      <!-- Register -->
    </form>
    <?php ActiveForm::end(); ?>
    <!-- Form -->
  </div>
</div>
