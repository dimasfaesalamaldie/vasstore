<?php

use kartik\tabs\TabsX;
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Barang;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
?>
<div class="stock-index">

    <p>
        
        <?= $this->render('_print', [
            'model' => $data,
        ]) ?>
    </p>

    <?php Pjax::begin([
        'enablePushState'=>FALSE,
        'id' => 'roppjax'
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
                        
            [
                'attribute'=>'sku_barang',
                'filter'=>ArrayHelper::map(Barang::find()->andWhere(['aktif'=>1])->all(), 'sku', function($data) {
                    return $data->sku. ' '.$data->nama. ' '.$data->warna. ' '.$data->gender;
                }),
                'value' => function ($data) {
                    return $data->sku_barang. ' '.$data->skuBarang->nama. ' '.$data->skuBarang->warna. ' '.$data->skuBarang->gender;
                },
            ],      
            [
                'attribute'=>'size',
            ],     
            [
                'attribute'=>'terjual',
            ],    
            [
                'attribute'=>'max',
            ],    
            [
                'attribute'=>'rerata',
            ],       
            [
                'attribute'=>'stock',
            ],    
            [
                'attribute'=>'rop',
            ],    

        ],
    ]); ?>
    <?php Pjax::end(); ?>


</div>

<?php
$script = <<< JS
$.pjax.reload({container:'#roppjax'});
JS;

$this->registerJs($script,
    yii\web\View::POS_END,
    'in-x-handler'
);?>
