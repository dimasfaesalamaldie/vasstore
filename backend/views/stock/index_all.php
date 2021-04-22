<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Barang;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SafetyStockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="safety-stock-index">


    <?php Pjax::begin([
        'enablePushState'=>FALSE,
        'id' => 'sfpjax'
    ]); ?>
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
                'attribute'=>'status',
                'filter'=> [
                    1 => 'Safe',
                    2 => 'Unsafe'
                ],
                'value' => function ($data) {
                    return $data->status == 1 ? 'Safe' : 'Unsafe';
                },
            ],   

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>


</div>

<?php
$script = <<< JS
$.pjax.reload({container:'#sfpjax'});
JS;

$this->registerJs($script,
    yii\web\View::POS_END,
    'in-x-handler'
);?>
