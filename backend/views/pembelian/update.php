<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pembelian */

$this->title = 'Update Pembelian ';
$this->params['breadcrumbs'][] = ['label' => 'Pembelians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_pembelian, 'url' => ['view', 'id' => $model->no_pembelian]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pembelian-update" style="width:80%;margin:auto;">

    <h1 align='center'><?= Html::encode($this->title) ?></h1>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
        'details' => $details,
        'barangs' => $barangs,
        'arr_barangs' => $arr_barangs,
    ]) ?>

</div>
