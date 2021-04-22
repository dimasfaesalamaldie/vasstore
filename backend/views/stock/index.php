<?php

use kartik\tabs\TabsX;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel app\models\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manajemen Data Stock';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-index">

    <h1><?=Html::encode($this->title)?></h1>
    <hr>

    <?=
TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => 'Semua',
            'content' => $this->render('index_all', [
                'searchModel' => $searchModelAll,
                'dataProvider' => $dataProviderAll,
            ]),
            'headerOptions' => ['style' => 'font-weight:bold'],
            'options' => ['id' => 'all'],
            'active' => true,
        ],
        [
            'label' => 'Unsafe',
            'content' => $this->render('index_unsafe', [
                'searchModel' => $searchModelUnsafe,
                'dataProvider' => $dataProviderUnsafe,
                'data' => $data,
            ]),
            'headerOptions' => ['style' => 'font-weight:bold'],
            'options' => ['id' => 'unsafe'],
        ],
    ],
])
?>


</div>
