<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use \yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Penjualan */
/* @var $form yii\widgets\ActiveForm */
?>

<link href=<?=\Yii::getAlias('@web').'/css/jquery.dataTables.css'?> rel="stylesheet" />
<?php $this->registerJsFile('@web/assets/jquery.dataTables.js', ['depends' => [\yii\web\JqueryAsset::className()]]);?>

<link href=<?=\Yii::getAlias('@web').'/css/select2.min.css'?> rel="stylesheet" />
<?php $this->registerJsFile('@web/assets/select2.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);?>

<div class="penjualan-form">

    <?php $form = ActiveForm::begin(['id'=>'penjualan-form']); ?>

    <?= $form->field($model, 'dibuat_oleh')->hiddenInput()->label(false)?>

    <?=$form->field($model, 'detail')->hiddenInput()->label(false)?>
    
    <div style="width: 100%;margin: auto;overflow: hidden;">
        <div style="width: 48%;float: left;">

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

        </div>
        <div style="margin-left: 52%;">
            <?= $form->field($model, 'no_penjualan')->textInput(['readOnly' => true])?>
            <?= $form->field($model, 'tanggal_penjualan')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => 'Pilih Waktu ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'dd-MM-yyyy H:i',
                    'autoclose'=>true,
                    'todayHighlight' => true
                ]
            ]) ?>
            <?= $form->field($model, 'keterangan')->textArea(['rows' => '3']) ?>


            <?= $form->field($model, 'total_harga')->textInput(['readOnly' => true])?>
        </div>
    </div>
    <hr>
    <div style="width: 100%;margin: auto;overflow: hidden;">
        <p>
            <?=Html::submitButton('Simpan', ['class' => 'btn btn-success', 'id' => '_submit'])?>
            <?=Html::button('Tambah Barang', ['id' => 'btn_barang', 'class' => 'btn btn-primary'])?>
            <?=Html::a('Reset', ['create'], ['class' => 'btn btn-danger',])?>
        </p>
    </div>
    <hr>


    <?php ActiveForm::end(); ?>

    <?php
    Modal::begin([
        'header' => '<h5><b>Tambah Barang</b></h5>',
        'id' => 'modal_barang',
        'size' => 'modal-lg',
        'closeButton' => [
            'id'=>'close-button',
            'class'=>'close',
            'data-dismiss' =>'modal',
            ],
        'clientOptions' => [
            'backdrop' => false, 'keyboard' => true
            ]
    ]);
    echo $this->render('_barang_picker', ['barangs' => $barangs]);
    Modal::end();
    ?>
    <?php
    Modal::begin([
        'header' => '<h5><b>Detail Barang</b></h5>',
        'id' => 'modal_detail',
        'size' => 'modal-sm',
        'closeButton' => [
            'id'=>'close-button',
            'class'=>'close',
            'data-dismiss' =>'modal',
            ],
        'clientOptions' => [
            'backdrop' => false, 'keyboard' => true
            ]
    ]);
    echo $this->render('_detail_picker', []);
    Modal::end();
    ?>
    <div style="width: 100%;margin:auto;">

        <table id="table_detail_2" class="display">
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Nama Barang</th>
                    <th>Size</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Total</th>
                    <th>-</th>
                </tr>
            </thead>
            <tbody id="body_jual">
            </tbody>
        </table>
    </div>
    <input type="hidden" id="_data" name="_data" value='<?=$arr_barangs?>'>
    <input type="hidden" id="_details" name="_data" value='<?=$details?>'>
    <input type="hidden" id="_url" name="_data" value='<?= Url::to(['penjualan/stock'])?>'>
</div>

<?php
$script = <<< JS

    var _url = $('#_url').val();
    var barangs = JSON.parse($('#_data').val());
    var pilihans =  JSON.parse($('#_details').val());

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
    
    $('#penjualan-form').on('beforeSubmit', function (e) {
        if(pilihans.length == 0) {                      
            Swal.fire({
                        type: 'error',
                        title: 'Barang Harus Ada',
                        text: 'Barang Penjualan tidak boleh kosong !',
                    });
                    return false;

        }
        return true;
    });
    var sizeSelect;
    $(document).ready(function () {
            sizeSelect = $('#size');
            document.getElementById('penjualan-total_harga').value = convertToRupiah( document.getElementById('penjualan-total_harga').value);
            $('#table_barang_2').DataTable();
            sizeSelect.select2({
                placeholder: "Pilih Ukuran",
                allowClear: true
            });
            $('#table_detail_2').DataTable({  
                'width': '80%',  
                'margin': 'auto',
                'fnInitComplete': function() {
                    $('table_jual_wrapper').css('width','60%');
                }
            });
            reDraw();
            sizeSelect.on('select2:select', function (e) {
                var data = e.params.data;
                $('#jumlah').val('0');
                max_stock = 1;
                for(var i = 0; i < stocks.length ; i ++) { 
                        if(stocks[i].size == data.id) {
                            max_stock = stocks[i].stock;
                        }
                    }      
    
            });
            
            document.getElementById('jumlah').addEventListener('keyup', function(e) {  
                    var max = max_stock;
                    var num = parseInt(this.value, 10),
                        min = 0;    
                    if (isNaN(num)) {
                        this.value = '0';
                        return;
                    }    
                    this.value = Math.max(num, min);
                    this.value = Math.min(num, max);
                });
    });
    var max_stock = 1;

    var pilihan = null;

    var stocks = null;
    document.getElementById('_add').addEventListener('click', function(){     
                     
            if(Number($('#jumlah').val()) == 0) {                               
                Swal.fire({
                    type: 'error',
                    title: 'Jumlah Penjualan!',
                    text: 'Jumlah Penjualan tidak boleh kosong !',
                });
                return false;
            }          
            if(isNaN($('#size').val())|| Number($('#size').val()) == 0) {
                Swal.fire({
                    type: 'error',
                    title: 'Size!',
                    text: 'Size Sepatu tidak boleh kosong !',
                });
                return false;
            }
            $('#modal_detail').modal('hide');   
            for( var i = 0 ; i < pilihans.length ; i ++) {
                if(pilihans[i].sku_barang === pilihan.sku_barang && pilihans[i].size ==  Number($('#size').val())) {
                    pilihans[i].jumlah = Number($('#jumlah').val());
                    pilihans[i].size = Number($('#size').val()); 
                    reDraw();
                    return;
                }
            }
            pilihan.jumlah = Number($('#jumlah').val());
            
            pilihan.harga_satuan = pilihan.harga;
            pilihan.size = Number($('#size').val());  
            pilihans.push(pilihan);            
            reDraw();
    });

    document.getElementById('btn_barang').addEventListener('click', function(){
        pilihan = null;
        $('#modal_barang').modal('show');      
    });

    function pilih(val) {
        $('#modal_barang').modal('hide');
        for( var i = 0 ; i < barangs.length ; i ++) {
            if(barangs[i].sku == val) {
                pilihan = JSON.parse(JSON.stringify(barangs[i]));
                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {sku:val},
                }).then(function (data) {
                    // create the option and append to Select2
                    sizeSelect.empty();

                    var option = new Option("Pilih Ukuran", null , true, true);
                    sizeSelect.append(option).trigger('change');
                    for(var i = 0; i < data.length ; i ++) { 
                        if(data[i].sku === val) {
                            var option = new Option(data[i].size + " (" + data[i].stock + ")", data[i].size , false, false);
                            sizeSelect.append(option).trigger('change');
                        }
                    }
                    stocks = data;
                    $('#jumlah').val('0');
                    $('#modal_detail').modal('show');   
                }); 
                break;
            }
        }
    }
    
    function reDraw() {
        $('#body_jual').empty();
        jum = 0;
        for (var i = 0; i < pilihans.length; i++) {
            addRow(pilihans[i]);
            jum += (pilihans[i].harga_satuan * pilihans[i].jumlah );
        }
        $('#penjualan-total_harga').val(convertToRupiah(jum));
        $('#penjualan-detail').val(JSON.stringify(pilihans));
    }

    function hapus(val) {          
        for( var i = 0 ; i < pilihans.length ; i ++) {
            if(pilihans[i].sku_barang == val.sku_barang  && pilihans[i].size == val.size) {
                pilihans.splice(i, 1);
                reDraw();
                return;
            }
        }
    }

    function addRow(data) {
        if (!document.getElementsByTagName) return;
        tabBody = document.getElementById('body_jual');//baru
        row = document.createElement('tr');
        cell1 = document.createElement('td');
        cell2 = document.createElement('td');
        cell3 = document.createElement('td');
        cell4 = document.createElement('td');
        cell5 = document.createElement('td');
        cell6 = document.createElement('td');
        cell7 = document.createElement('td');
        sku = document.createTextNode(data.sku);
        nama = document.createTextNode(data.nama);
        size = document.createTextNode(data.size);
        jumlah = document.createTextNode(data.jumlah);
        harga_satuan = document.createTextNode(convertToRupiah(data.harga_satuan));
        total = document.createTextNode(convertToRupiah(data.harga_satuan * data.jumlah ));
         
        var btn = document.createElement('input');

        btn.setAttribute('type', 'button');
        btn.setAttribute('class', 'btn btn-xs btn-danger');
        btn.setAttribute('value', 'Hapus');
        btn.setAttribute('onclick', 'hapus('+ JSON.stringify(data) +')');
        btn.style.width = '50px';

        cell1.appendChild(sku);
        cell2.appendChild(nama);
        cell3.appendChild(size);
        cell4.appendChild(jumlah);
        cell5.appendChild(harga_satuan);
        cell6.appendChild(total);
        cell7.appendChild(btn);

        row.appendChild(cell1);
        row.appendChild(cell2);
        row.appendChild(cell3);
        row.appendChild(cell4);
        row.appendChild(cell5);
        row.appendChild(cell6);
        row.appendChild(cell7);
        tabBody.appendChild(row);
    }
JS;

$this->registerJs($script,
    yii\web\View::POS_END,
    'in-x-handler'
);?>