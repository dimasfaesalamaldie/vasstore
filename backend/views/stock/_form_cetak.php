<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Barang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="barang-form">

    <?php $form = ActiveForm::begin();?>

    <?=$form->field($cetak, 'biaya_pemesanan')->textInput()?>
    
    <?php foreach ($cetak->ids as $key => $id): ?>
    <?=$form->field($cetak, 'ids[' . $key . ']')->hiddenInput()->label(false)?>
    <?php endforeach;?>

    <?php foreach ($cetak->models as $key => $model): ?>
    <hr>
    <h4><b><?=$model->sku . ' ' . $model->nama. ' Rp. ' . number_format($model->harga)?></b></h4>

    <div style="width:100%;">
        <div style="width:48%;float:left;">
            <?=$form->field($cetak, 'biaya_penyimpanan[' . $key . ']')->textInput()->label('Biaya Penyimpanan (% dari harga)')?>
        </div>
        <div style="margin-left:52%;">
            <?=$form->field($cetak, 'harga_beli[' . $key . ']')->textInput()?>
        </div>
    </div>

    <?php endforeach;?>
    <br>
    <div class="form-group">
        <?=Html::submitButton('Cetak', ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end();?>

</div>

<input type='hidden' id='_data' value='<?=json_encode($cetak->sku, true)?>'>

<?php
$script = <<< JS
    var data = JSON.parse($('#_data').val());

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
                document.getElementById('cetak-biaya_pemesanan').value = convertToRupiah( document.getElementById('cetak-biaya_pemesanan').value);
                document.getElementById('cetak-biaya_pemesanan').addEventListener('keyup', function(e) {
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
            for(var i = 0 ; i < data.length ; i ++) {
                var id = data[i].toLowerCase();

                document.getElementById('cetak-biaya_penyimpanan-'+id).value = convertToRupiah( document.getElementById('cetak-biaya_penyimpanan-'+id).value);
                document.getElementById('cetak-harga_beli-'+id).value = convertToRupiah( document.getElementById('cetak-harga_beli-'+id).value);

                document.getElementById('cetak-harga_beli-'+id).addEventListener('keyup', function(e) {
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

                document.getElementById('cetak-biaya_penyimpanan-'+id).addEventListener('keyup', function(e) {
                    var num = parseInt(this.value, 10),
                        min = 0,
                        max = 100;
                    if (isNaN(num)) {
                        this.value = '0';
                        return;
                    }
                    this.value = Math.max(num, min);
                    this.value = Math.min(num, max);
                });
            }
    });



JS;

$this->registerJs($script,
    yii\web\View::POS_END,
    'in-x-handler'
);?>