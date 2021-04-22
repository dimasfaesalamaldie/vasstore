<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DetailPenjualanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detail Penjualans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-penjualan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Detail Penjualan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_detail',
            'no_penjualan',
            'sku_barang',
            'id_stock',
            'size',
            //'jumlah',
            //'harga_satuan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
