<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Penjualan */

$this->title = 'Update Penjualan: ' . $model->no_penjualan;
$this->params['breadcrumbs'][] = ['label' => 'Penjualans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_penjualan, 'url' => ['view', 'id' => $model->no_penjualan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penjualan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
