<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Penjualan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penjualan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_penjualan')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'tanggal_penjualan')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'jenis_kelamin')
    ->dropDownList(
        [
            'Laki-laki' => 'Laki-laki',
            'Perempuan' => 'Perempuan',
        ], 
        ['prompt' => 'Pilih Jenis Kelamin ....']
    )?>

    <?=$form->field($model, 'pekerjaan')
    ->dropDownList(
        $model->kerjalist(), 
        ['prompt' => 'Pilih Pekerjaan ....']
    )?>

    <?= $form->field($model, 'umur')->textInput(['type'=>'number']) ?>

    <?= $form->field($model, 'total_harga')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'keterangan')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'dibuat_oleh')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Lanjut', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
