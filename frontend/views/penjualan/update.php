<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Penjualan */

$this->title = 'Update Penjualan: ' . $model->no_penjualan;
$this->params['breadcrumbs'][] = ['label' => 'Penjualans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_penjualan, 'url' => ['view', 'id' => $model->no_penjualan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<style>
    * {
        box-sizing: border-box;
    }

    /* Create three equal columns that floats next to each other */
    .column {
        float: left;
        width: 33.33%;
        padding: 10px;
        height: relative;
        /* Should be removed. Only for demonstration */
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
</style>
<div class="penjualan-update" style="width:80%;margin:auto;">

    <h1 align='center'><?= Html::encode($this->title) ?></h1>
    <hr>
    <?php if(!empty($rekom)) echo '<h4>Rekomendasi Sepatu</h4>'  ?>

    <div class="row">
        <div class="column">
            <?php if(isset($rekom[0])):  ?>
            <div id='corner-w' align='center'>
                <b><?= $rekom[0]->sku  ?></b><br>
                <b><?= $rekom[0]->nama  ?></b><br>
                <b><?= number_format($rekom[0]->harga)  ?></b>
            </div>
            <?php endif;  ?>
        </div>
        <div class="column" >
            <?php if(isset($rekom[1])):  ?>
            <div id='corner-w' align='center'>
                <b><?= $rekom[1]->sku  ?></b><br>
                <b><?= $rekom[1]->nama  ?></b><br>
                <b><?= number_format($rekom[1]->harga)  ?></b>
            </div>
            <?php endif;  ?>
        </div>
        <div class="column" >
            <?php if(isset($rekom[2])):  ?>
            <div id='corner-w' align='center'>
                <b><?= $rekom[2]->sku  ?></b><br>
                <b><?= $rekom[2]->nama  ?></b><br>
                <b><?= number_format($rekom[2]->harga)  ?></b>
            </div>
            <?php endif;  ?>
        </div>
    </div>
    <hr>
    <?=  $this->render('_form', [
        'model' => $model,
        'rekom' => $rekom,
        'details' => $details,
        'barangs' => $barangs,
        'arr_barangs' => $arr_barangs,
    ]) ?>

</div>
