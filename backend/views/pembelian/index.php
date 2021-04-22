<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PembelianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manajemen Pembelian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembelian-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <p>
        <?= Html::a('Buat Pembelian', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            //'dibuat_oleh',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
