<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Kriteria;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manajemen Data Barang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barang-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <p>
        <?= Html::a('Buat Data Barang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sku',
            [
                'attribute'=>'id_kriteria',
                'filter'=>ArrayHelper::map(Kriteria::find()->asArray()->all(), 'id_kriteria', 'nama'),
                'value' => function ($data) {
                    return $data->kriteria->nama;
                },
            ],
            'nama',
            'warna',
            'gender',
            [
                'attribute'=>'harga',
                'value' => function ($data) {
                    return 'Rp. '.number_format($data->harga);
                },
            ],
            //'dibuat_oleh',
            //'diubah_oleh',
            [
                'attribute'=>'aktif',
                'filter'=>[
                    1 => 'Aktif',
                    0 => 'Tidak'
                ],
                'value' => function($data) {
                    return $data->aktif == 1 ? 'Aktif' : 'Tidak';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
