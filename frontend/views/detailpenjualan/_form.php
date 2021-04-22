<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DetailPenjualan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detail-penjualan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_detail')->textInput() ?>

    <?= $form->field($model, 'no_penjualan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sku_barang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_stock')->textInput() ?>

    <?= $form->field($model, 'size')->textInput() ?>

    <?= $form->field($model, 'jumlah')->textInput() ?>

    <?= $form->field($model, 'harga_satuan')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
