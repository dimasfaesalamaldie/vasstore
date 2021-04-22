<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DetailPembelianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detail Pembelians';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-pembelian-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Detail Pembelian', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_detail',
            'no_pembelian',
            'sku_barang',
            'size',
            'jumlah',
            //'harga_satuan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
