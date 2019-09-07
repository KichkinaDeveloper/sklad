<?php 
use yii\widgets\LinkPager;
use yii\helpers\Url;
?>
<a href="<?=Url::to(['/product/index'])?>" class="btn btn-success mt-4" style="margin-left:0px; margin-bottom:15px">Orqaga Qaytish
</a>
<table class="table table-striped table-bordered mt-4">
  <thead class="mdb-color darken-5">
    <tr class="text-white">
      <th>#</th>
      <th>Mahsulot Nomi</th>
      <th>Mahsulot Soni</th>
 
    </tr>
  </thead>
    <?php $k = 1; ?>    
    <?php foreach($query as $m): ;?>
    <?php if($m->count/$m->maximal < 1/2): ?>
    <tr>
        <td><?=$k?></td>
        <td><?=$m->name;?></td>
        <td><?=$m->count;?></td>
        
      </tr>
      <?php elseif($m->count/$m->maximal > 1/2): ?>   
      <?php continue; ?>
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