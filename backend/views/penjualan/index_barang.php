<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\DetailPenjualan;
use kartik\daterange\DateRangePicker;
use common\models\Barang;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

?>
<div class="penjualan-index">
    <p>        
        <?= $this->render('_print', [
            'model' => $data,
        ]) ?>
    </p>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'tanggal_penjualan',
                'label' => 'Tanggal Penjualan',
                'filter' => '<div class="drp-container input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>' .
                DateRangePicker::widget([
                    'name' => 'DetailPenjualanSearch[tanggal_penjualan]',
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
                'value'=>function($data) {
                    return date('d-m-Y H:i', strtotime($data->noPenjualan->tanggal_penjualan));
                },
            ],
            [
                'attribute'=>'sku_barang',
                'filter' => ArrayHelper::map(Barang::find()->all(), 'sku', function($data) {
                    return $data->sku. ' '. $data->nama;
                }),
                'value'=>function($data) {
                    return $data->sku_barang . ' '.$data->skuBarang->nama;
                }
            ],
            'size',
            'jumlah',
            'no_penjualan',

        ],
    ]); ?>


</div>

<?php
$script = <<< JS
//$.pjax.reload({container:'#barangpjax'});
JS;

$this->registerJs($script,
    yii\web\View::POS_END,
    'in-x-handler'
);?>
