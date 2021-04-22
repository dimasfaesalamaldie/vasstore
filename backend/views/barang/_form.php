<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Kriteria;
use yii\helpers\ArrayHelper;

if (empty($model->sku)) {
    $model->aktif = 1;
}

/* @var $this yii\web\View */
/* @var $model app\models\Barang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="barang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'sku')->textInput(['readOnly' => !$model->isNewRecord]) ?>

    <?=$form->field($model, 'id_kriteria')->dropDownList(
        ArrayHelper::map(Kriteria::find()->asArray()->all(), 'id_kriteria', 'nama'),
        ['prompt' => ' - Pilih Kriteria -']
    )
    ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'warna')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'gender')->dropDownList(
        [
            'U' => 'Universal',
            'F' => 'Female',
            'M' => 'Male'
        ],
        ['prompt' => ' - Pilih Gender Sepatu -']
    )
    ?>

    <?= $form->field($model, 'leadtime')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'biaya_penyimpanan')->textInput()->label('Biaya Penyimpanan (% dari harga)') ?>

    <?= $form->field($model, 'harga')->textInput()?>

    <?= $form->field($model, 'keterangan')->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'dibuat_oleh')->hiddenInput()->label(false) ?>
    
    <?= $form->field($model, 'diubah_oleh')->hiddenInput()->label(false) ?>
    
    <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>

    <?=$form->field($model, 'aktif')->checkbox()?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$script = <<< JS

    function convertToRupiah(angka)
    {
        var rupiah = '';		
        var angkarev = angka.toString().split('').reverse().join('');
        for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
        return rupiah.split('',rupiah.length-1).reverse().join('');
    }

    function convertToAngka(rupiah)
    {
        return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
    }
    

    $(document).ready(function () {
            document.getElementById('barang-harga').value = convertToRupiah( document.getElementById('barang-harga').value);
    });
    
    document.getElementById('barang-biaya_penyimpanan').addEventListener('keyup', function(e) {        
        var num = parseInt(this.value, 0),
            min = 0,
            max = 100;    
            console.log(num);
        if (isNaN(num)) {
            this.value = '';
            return;
        } else if(this.value > 100) {
            this.value = 100;
        }
    });

    document.getElementById('barang-harga').addEventListener('keyup', function(e) {        
        var num = parseInt(convertToAngka(this.value), 10),
            min = 0,
            max = 1000000000;    
        if (isNaN(num)) {
            this.value = '0';
            return;
        }    
        this.value = Math.max(num, min);
        this.value = Math.min(num, max);
        this.value = convertToRupiah(this.value);
    });
    
    document.getElementById('barang-harga').addEventListener('keyup', function(e) {        
        var num = parseInt(convertToAngka(this.value), 10),
            min = 0,
            max = 1000000000;    
        if (isNaN(num)) {
            this.value = '0';
            return;
        }    
        this.value = Math.max(num, min);
        this.value = Math.min(num, max);
        this.value = convertToRupiah(this.value);
    });
    

JS;

$this->registerJs($script,
    yii\web\View::POS_END,
    'in-x-handler'
);?>