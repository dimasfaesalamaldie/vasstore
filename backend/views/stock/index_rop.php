<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Barang;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reorder Point';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-index">

    <h1><?=Html::encode($this->title)?></h1>
    <hr>


    <p>
        
        <?= $this->render('_print', [
            'model' => $data,
        ]) ?>
    </p>

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
            [
                'attribute'=>'status',
                'filter'=> [
                    1 => 'Safe',
                    2 => 'Unsafe'
                ],
                'value' => function ($data) {
                    return $data->status == 1 ? 'Safe' : 'Unsafe';
                },
            ],   

        ],
    ]); ?>


</div>
