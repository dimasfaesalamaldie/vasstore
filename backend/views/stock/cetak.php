<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Stock */

$this->title = 'Verifikasi Order';
$this->params['breadcrumbs'][] = ['label' => 'Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-create" style="width:80%;margin:auto;">

    <h1 align='center'><?= Html::encode($this->title) ?></h1>
    <hr>

    <?= $this->render('_form_cetak', [
        'cetak' => $cetak,
    ]) ?>

</div>
