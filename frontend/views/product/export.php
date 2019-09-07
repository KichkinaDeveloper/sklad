<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin(); ?>
<div class="md-form w-50">
  <input placeholder="Dastlabki vaqt" name="first" type="text" id="date-picker-example" class="form-control datepicker">
</div>
<div class="md-form w-50">
  <input placeholder="Oxirgi vaqt" name="last" type="text" id="date-picker-example" class="form-control datepicker">
</div>

<select class="browser-default custom-select w-25" name="sel">
  <option selected disabled>-Tanlang-</option>
  <option value="1" name="bir">Sotilgan mahsulotlar</option>
  <option value="2" name="ikki">Qo'shilgan mahsulotlar</option>
  <option value="3" name="uch">Sotilgan va Qo'shilgan mahsulotlar</option>
</select>

<div class="form-group mt-3">
        <?= Html::submitButton('Export', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>