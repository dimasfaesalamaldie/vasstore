<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BarangSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="barang-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sku') ?>

    <?= $form->field($model, 'id_kriteria') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'keterangan') ?>

    <?= $form->field($model, 'warna') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'harga') ?>

    <?php // echo $form->field($model, 'dibuat_oleh') ?>

    <?php // echo $form->field($model, 'diubah_oleh') ?>

    <?php // echo $form->field($model, 'aktif') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
