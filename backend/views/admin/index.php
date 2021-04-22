<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manajemen Data Admin';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <p>
        <?= Html::a('Buat Admin', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'nama',
            [
                'attribute'=>'role',
                'filter'=>[
                    1 => 'Manajer',
                    2 => 'Admin'
                ],
                'value' => function($data) {
                    return $data->role == 1 ? 'Manajer' : 'Admin';
                }
            ],
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
            //'auth_key',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>


</div>
