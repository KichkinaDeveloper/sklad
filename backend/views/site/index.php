<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<?php
use yii\helpers\Url;
?>

<div class="site-index">

    <h1 style="text-align:center; margin-bottom:20px; font-family:Georgia, 'Times New Roman', Times, serif;">Kategoriyalar</h1>
    <a href="<?= Url::to(['kategory/create']) ?>" class="btn btn-primary" style="padding:30px; font-size:30px; margin-left:220px;font-family:Georgia, 'Times New Roman', Times, serif;">Kategoriya yaratish</a>
    <a href="<?= Url::to(['kategory/index']) ?>" class="btn btn-success" style="padding:30px; font-size:30px; margin-left:80px;font-family:Georgia, 'Times New Roman', Times, serif;">Kategoriyalarni ko'rish</a>
    
    <hr>

    <h1 style="text-align:center; margin-bottom:20px;font-family:Georgia, 'Times New Roman', Times, serif;">Mahsulot</h1>
    <a href="<?= Url::to(['product/add']) ?>" class="btn btn-primary" style="padding:30px; font-size:30px; margin-left:220px;font-family:Georgia, 'Times New Roman', Times, serif;">Mahsulot qo'shish</a>
    <a href="<?= Url::to(['product/index']) ?>" class="btn btn-success" style="padding:30px; font-size:30px; margin-left:98px;font-family:Georgia, 'Times New Roman', Times, serif;">Mahsulotlarni ko'rish</a>
    
    <hr>

    <h1 style="text-align:center; margin-bottom:20px;font-family:Georgia, 'Times New Roman', Times, serif;">O'lchov</h1>
    <a href="<?= Url::to(['birlik/create']) ?>" class="btn btn-primary" style="padding:30px; font-size:30px; margin-left:220px;font-family:Georgia, 'Times New Roman', Times, serif;">O'lchov qo'shish</a>
    <a href="<?= Url::to(['birlik/index']) ?>" class="btn btn-success" style="padding:30px; font-size:30px; margin-left:128px;font-family:Georgia, 'Times New Roman', Times, serif;">O'lchovlarni ko'rish</a>
    
    <hr>
</div>