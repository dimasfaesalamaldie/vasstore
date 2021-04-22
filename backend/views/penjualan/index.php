<?php

use kartik\tabs\TabsX;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PenjualanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penjualan-index">

<h1><?=Html::encode($this->title)?></h1>
    <hr>
    <?=
    TabsX::widget([
        'position' => TabsX::POS_ABOVE,
        'align' => TabsX::ALIGN_LEFT,
        'items' => [
            [
                'label' => 'Penjualan',
                'content' => $this->render('index_penjualan', [
                    'searchModel' => $searchModelPen,
                    'dataProvider' => $dataProviderPen,
                    'data' => $dataPen,
                    'model' => $model,
                ]),
                'headerOptions' => ['style' => 'font-weight:bold'],
                'options' => ['id' => 'Penjualan'],
                'active' => true,
            ],
            [
                'label' => 'Barang',
                'content' => $this->render('index_barang', [
                    'searchModel' => $searchModelBarang,
                    'dataProvider' => $dataProviderBarang,
                    'data' => $dataBarang,
                ]),
                'headerOptions' => ['style' => 'font-weight:bold'],
                'options' => ['id' => 'Barang'],
            ],
        ],
    ])
    ?>
</div>
