<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\DetailPenjualan;

?>
<div class="penjualan-index">

    <h1 align='center'>Laporan Penjualan Vaststore</h1>
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
                'header'=>'No. Penjualan',
                'value'=>function($data) {
                    return $data->no_penjualan;
                }
            ],
            [
                'header' => 'Tanggal Penjualan',
                'value' => function ($data) {
                    return date('d-m-Y H:i', strtotime($data['tanggal_penjualan']));
                },
            ],
            [
                'header'=>'Nama',
                'value'=>function($data) {
                    return $data->nama;
                }
            ],
            [
                'header'=>'Jenis Kelamin',
                'value'=>function($data) {
                    return $data->jenis_kelamin;
                }
            ],
            [
                'header'=>'Pekerjaan',
                'value'=>function($data) {
                    return $data->pekerjaan;
                }
            ],
            [
                'header'=>'Umur',
                'value'=>function($data) {
                    return $data->umur. ' Tahun';
                }
            ],
            [
                'header'=>'Total Harga',
                'value'=>function($data) {
                    return 'Rp. '.number_format($data->total_harga);
                }
            ],
            [
                'attribute'=>'sku',
                'value'=>function($data) {
                    $txt = '';
                    foreach(DetailPenjualan::find()->andWhere(['no_penjualan'=>$data->no_penjualan])->all() as $det) {
                        $txt .= $det->sku_barang . ' '.$det->skuBarang->nama. ' ('.$det->jumlah . '), ';
                    }
                    return substr($txt, 0, -2);
                }
            ],
            [
                'header'=>'Dibuat Oleh',
                'value'=>function($data) {
                    return $data->dibuat_oleh;
                }
            ],
        ],
    ]); ?>


</div>
