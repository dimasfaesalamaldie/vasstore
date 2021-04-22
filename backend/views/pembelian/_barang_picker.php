<?php

use yii\helpers\Html;
use \yii\helpers\Url;
use yii\web\View;
use common\models\BarangSatuan;

?>


<table id="table_barang" class="display">
    <thead>
        <tr>
            <th>SKU</th>
            <th>Kriteria</th>
            <th>Nama Barang</th>
            <th>Warna</th>
            <th>Gender</th>
            <th>Keterangan</th>
            <th>-</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($barangs as $p){?>
        <tr>
            <td><?= $p->sku?></td>
            <td><?= $p->kriteria->nama?></td>
            <td><?= $p->nama?></td>
            <td><?= $p->warna?></td>
            <td><?= $p->gender?></td>
            <td><?= $p->keterangan?></td>
            <td><input id="Pilih" type="button" value="Pilih" onclick="pilih('<?=$p->sku ?>');" /></td>
            
        </tr>
        
        <?php }?>
    </tbody>
</table>