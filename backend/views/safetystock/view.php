<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\SafetyStock */

$this->title = 'Detail Safety Stock';
$this->params['breadcrumbs'][] = ['label' => 'Safety Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="safety-stock-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
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
                ],
            ]) ?>
        </div>
        <div style='margin-left:52%;'>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'warna',
                    'gender',
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
                ],
            ]) ?>
        </div>
    </div>
    <h3>Safety Stock</h3>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
                        
            'size',   
            [
                'attribute'=>'stock',
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
                'attribute'=>'safety_stock',
            ],    
            [
                'attribute'=>'status',
                'value' => function ($data) {
                    return $data->status == 1 ? 'Safe' : 'Unsafe';
                },
            ],   

        ],
    ]); ?>
</div>
