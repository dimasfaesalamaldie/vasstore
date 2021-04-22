<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Penjualan */

$this->title = 'Data Pembeli';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penjualan-create" style="width:60%;margin:auto;">

    <h1 align='center'><?= Html::encode($this->title) ?></h1>
    <hr>

    <?= $this->render('_form_pembeli', [
        'model' => $model,
    ]) ?>

</div>
