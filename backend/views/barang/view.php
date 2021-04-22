<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Barang */

$this->title = 'Detail Sepatu';
$this->params['breadcrumbs'][] = ['label' => 'Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="barang-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->sku], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->sku], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div style='width:100%;overflow:hidden;'>
        <div style='width:48%;float:left;'>
            
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'sku',
                    [
                        'attribute'=>'id_kriteria',
                        'value' => function ($data) {
                            return $data->kriteria->nama;
                        },
                    ],
                    'nama',
                    'keterangan',
                    'warna',
                    'gender',
                ],
            ]) ?>
        </div>
        <div style='margin-left:52%;'>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute'=>'leadtime',
                        'value' => function ($data) {
                            return $data->leadtime. ' Hari';
                        },
                    ],
                    [
                        'attribute'=>'harga',
                        'value' => function ($data) {
                            return 'Rp. '.number_format($data->harga);
                        },
                    ],
                    [
                        'attribute'=>'biaya_penyimpanan',
                        'value' => function ($data) {
                            return $data->biaya_penyimpanan . ' %';
                        },
                    ],
                    'dibuat_oleh',
                    'diubah_oleh',
                    [
                        'attribute'=>'aktif',
                        'value' => function($data) {
                            return $data->aktif == 1 ? 'Aktif' : 'Tidak';
                        }
                    ],
                    [
                        'attribute'=>'status',
                        'value' => function($data) {
                            return $data->status == 1 ? 'Safe' : 'Unsafe';
                        }
                    ],
                ],
            ]) ?>
        </div>
    </div>
    <h3>Detail Barang</h3>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
                        
            'size',
            'terjual',
            'stock',
            [
                'attribute'=>'status',
                'value' => function ($data) {
                    return $data->status == 1 ? 'safe' : 'Unsafe';
                },
            ],   

        ],
    ]); ?>
</div>
