<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DetailPenjualanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detail-penjualan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_detail') ?>

    <?= $form->field($model, 'no_penjualan') ?>

    <?= $form->field($model, 'sku_barang') ?>

    <?= $form->field($model, 'id_stock') ?>

    <?= $form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'jumlah') ?>

    <?php // echo $form->field($model, 'harga_satuan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
