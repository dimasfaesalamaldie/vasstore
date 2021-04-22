<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\DetailPenjualan;

?>
<div class="penjualan-index">

    <h1 align='center'>Laporan Penjualan Barang</h1>
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
    <hr>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Tanggal Penjualan',
                'value'=>function($data) {
                    return date('d-m-Y H:i', strtotime($data->noPenjualan->tanggal_penjualan));
                },
            ],
            [
                'label' => 'Barang',
                'attribute'=>'sku_barang',
                'value'=>function($data) {
                    return $data->sku_barang . ' '.$data->skuBarang->nama;
                }
            ],
            [
                'label' => 'Size',
                'value'=>function($data) {
                    return $data->size;
                }
            ],
            [
                'label' => 'Jumlah',
                'value'=>function($data) {
                    return $data->jumlah;
                }
            ],
            [
                'label' => 'No. Penjualan',
                'value'=>function($data) {
                    return $data->no_penjualan;
                }
            ],
        ],
    ]); ?>
</div>
