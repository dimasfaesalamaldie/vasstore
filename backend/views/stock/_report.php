<?php

use yii\helpers\Html;
use yii\grid\GridView;

?>

<div class="stock-index">

    <h1 align='center'>Laporan Order Barang</h1>
    <br>
    <div style="overflow: hidden;">
        <div style="width: 100px;float: left;">
            Dicetak pada
            <br>
            <?= Yii::$app->user->identity->role == 1 ? 'Manajer' : 'Admin' ?>
        </div>
        <div style="margin-left: 120px;">
             : <?= ' '. date('d-m-Y') ?><br>
             :  <?= Yii::$app->user->identity->nama  ?>
        </div>
    </div> 
    <br>  
    <hr>
    <table style="width: 100%;">
        <tr>
            <th style="width: 60%;">Barang</th>
            <th style="width: 20%;">Size</th>
            <th>Jumlah Order</th>
        </tr>
        <?php foreach($data as $d):?>
        <tr>
            <td>
                <?= $d->skuBarang->sku. ' '.$d->skuBarang->nama. ' '.$d->skuBarang->warna. ' '.$d->skuBarang->gender?>
            </td>
            <td>
                <?= $d->size?>
            </td>
            <td>
                <?= round($d->eoq) ?>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
    <br><br>

    <div style="width:300px;margin-top:20px;" align='center'>
    </div>
</div>
