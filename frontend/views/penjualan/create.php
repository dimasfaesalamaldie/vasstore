<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Penjualan */

$this->title = 'Buat Penjualan' ;
$this->params['breadcrumbs'][] = $this->title;
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

<div class="penjualan-create" style="width:80%;margin:auto;">

    <h1 align='center' ><?= Html::encode($this->title) ?></h1>
    <hr>
    
    <?=  $this->render('_form', [
        'model' => $model,
        'details' => $details,
        'barangs' => $barangs,
        'arr_barangs' => $arr_barangs,
    ]) ?>
</div>