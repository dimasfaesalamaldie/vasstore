<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\models\Barang;

/* @var $this yii\web\View */
/* @var $model app\models\Pembelian */

$this->title = 'Detail Pembelian';
$this->params['breadcrumbs'][] = ['label' => 'Pembelians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pembelian-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->no_pembelian], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->no_pembelian], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'no_pembelian',
            'no_faktur',
            'tanggal_pembelian',
            [
                'attribute'=>'total_harga',
                'value'=>function($data) {
                    return 'Rp. '.number_format($data->total_harga);
                }
            ],
            'keterangan',
            'dibuat_oleh',
        ],
    ]) ?>
    <h3>Detail Barang</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
             
            [
                'attribute'=>'sku_barang',
                'value' => function ($data) {
                    return $data->sku_barang. ' '.$data->skuBarang->nama. ' '.$data->skuBarang->warna. ' '.$data->skuBarang->gender;
                },
            ],
            'size',
            'jumlah',
            [
                'attribute'=>'harga_satuan',
                'value'=>function($data) {
                    return 'Rp. '.number_format($data->harga_satuan);
                }
            ],
        ],
    ]); ?>
</div>
