<?php 
use yii\helpers\Url;
use yii\widgets\LinkPager;
use common\models\Product;
use common\models\Birlik;

?>

<?php if(!\Yii::$app->user->isGuest):?>
<a href="<?=Url::to(['/product/send'])?>" class="btn btn-primary mt-4" style="margin-left:0px; margin-bottom:15px">Sotish
</a>
<a href="<?=Url::to(['/product/export'])?>" class="btn btn-success mt-4" style="margin-left:0px; margin-bottom:15px">Excel
</a>
<a href="<?=Url::to(['/product/decrease'])?>" class="btn btn-danger mt-4" style="margin-left:0px; margin-bottom:15px">Kamaygan
</a>
<a href="<?=Url::to(['/product/add'])?>" class="btn btn-info mt-4" style="margin-left:0px; margin-bottom:15px">Qo'shish
</a>
<?php elseif(\Yii::$app->user->isGuest):?>
<h2 class="text-center mt-3 font-weight-bold">Iltimos siz Avval ro'yhatdan o'ting!</h2>

<?php endif?>

<table class="table table-striped table-bordered mt-2">
  <thead class="mdb-color darken-5">
    <tr class="text-white">
      <th>#</th>
      <th>Mahsulot Nomi</th>
      <th>Mahsulot Soni</th>
      <th>Mahsulot Birligi</th>
    </tr>
  </thead>
    <?php $k = 1; ?>    
    <?php foreach($all as $m): ;?>
    <?php if($m['pcount']/$m['maximal'] < 1/2): ?>
    <tr style="background:red">
        <td><?=$k?></td>
        <td><?=$m['pname'];?></td>
        <td><?=$m['pcount'];?></td>
        <td><?=$m['bnomi'];?></td>
      </tr>
      <?php elseif($m['pcount']/$m['maximal'] > 1/2): ?>   
      <tr>
        <td><?=$k?></td>
        <td><?=$m['pname'];?></td>
        <td><?=$m['pcount'];?></td>
        <td><?=$m['bnomi'];?></td>
      </tr>
      <?php endif;?>
      <?php $k++; ?>    
    <?php endforeach;?>
  </tbody>
</table>
<div style="margin-left:480px">
<?=LinkPager::widget([
    'pagination' => $pagination,
    'pageCssClass' => "page-item",
    'linkOptions' => [
        'class' => 'page-link'
    ],
    'disabledPageCssClass' => "d-none"
])?>
</div>