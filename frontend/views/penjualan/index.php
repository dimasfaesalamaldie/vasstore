<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PenjualanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manajemen Penjualan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penjualan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'no_penjualan',
            [
                'attribute' => 'tanggal_penjualan',
                'label' => 'Tanggal Penjualan',
                'filter' => '<div class="drp-container input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>' .
                DateRangePicker::widget([
                    'name' => 'PenjualanSearch[tanggal_penjualan]',
                    'value'=> $searchModel->tanggal_penjualan,
                    'pluginOptions' => [
                        'locale' => [
                            'separator' => ' to ',
                            'format'=>'D-M-YYYY'
                        ],
                        'opens' => 'right',
                    ],
                    'pluginEvents'=>[
                        'cancel.daterangepicker'=> "function(ev, picker) {
                            $('#w1').val(''); 
                        }"
                  ]
                ]) . '</div>',
                'content' => function ($data) {
                    return date('d-m-Y H:i', strtotime($data['tanggal_penjualan']));
                },
            ],
            'nama',
            [
                'attribute'=>'jenis_kelamin',
                'filter'=> [
                    'Laki-laki' => 'Laki-laki',
                    'Perempuan' => 'Perempuan',
                ]
            ],
            [
                'attribute'=>'pekerjaan',
                'filter'=> $model->kerjalist()
            ],
            [
                'attribute'=>'umur',
                'value'=>function($data) {
                    return $data->umur. ' Tahun';
                }
            ],
            [
                'attribute'=>'total_harga',
                'value'=>function($data) {
                    return 'Rp. '.number_format($data->total_harga);
                }
            ],
            //'keterangan',
            //'dibuat_oleh',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
            ],
        ],
    ]); ?>


</div>
