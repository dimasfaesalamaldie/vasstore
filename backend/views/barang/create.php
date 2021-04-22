<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Barang */

$this->title = 'Buat Data Barang';
$this->params['breadcrumbs'][] = ['label' => 'Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barang-create" style="width:80%;margin:auto;">

    <h1 align='center'><?= Html::encode($this->title) ?></h1>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
