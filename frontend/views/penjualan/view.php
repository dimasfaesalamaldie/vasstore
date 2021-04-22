<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Penjualan */

$this->title = 'Detail Penjualan';
$this->params['breadcrumbs'][] = ['label' => 'Penjualans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="penjualan-view">

    <h1><?=Html::encode($this->title)?></h1>
    <hr>
    <?=DetailView::widget([
    'model' => $model,
    'attributes' => [
        'no_penjualan',
        'tanggal_penjualan',
        'nama',
        'jenis_kelamin',
        'pekerjaan',
        [
            'attribute' => 'umur',
            'value' => function($data) {
                return $data->umur . ' Tahun';
            }
        ],
        [
            'attribute' => 'total_harga',
            'value' => function($data) {
                return 'Rp. '.number_format($data->total_harga);
            }
        ],
        'keterangan',
        'dibuat_oleh',
    ],
])?>

<h3>Detail Barang</h3>

<?=GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'sku_barang',
            'value' => function ($data) {
                return $data->sku_barang . ' ' . $data->skuBarang->nama . ' ' . $data->skuBarang->warna . ' ' . $data->skuBarang->gender;
            },
        ],
        'size',
        'jumlah',
        [
            'attribute' => 'harga_satuan',
            'value' => function ($data) {
                return 'Rp. ' . number_format($data->harga_satuan);
            },
        ],

    ],
]);?>
</div>
