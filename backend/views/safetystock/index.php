<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Barang;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SafetyStockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Safety Stocks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="safety-stock-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
                        
            [
                'attribute'=>'sku',
                'filter'=>ArrayHelper::map(Barang::find()->andWhere(['aktif'=>1])->all(), 'sku', function($data) {
                    return $data->sku. ' '.$data->nama. ' '.$data->warna. ' '.$data->gender;
                }),
                'value' => function ($data) {
                    return $data->sku. ' '.$data->nama. ' '.$data->warna. ' '.$data->gender;
                },
            ],         
            [
                'attribute'=>'leadtime',
                'value' => function ($data) {
                    return $data->leadtime. ' Hari';
                },
            ],      
            [
                'attribute'=>'safety_stock',
                'filter'=> [
                    1 => 'safe',
                    2 => 'unsafe'
                ],
                'value' => function ($data) {
                    return $data->safety_stock == 1 ? 'safe' : 'Unsafe';
                },
            ],   

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>


</div>
