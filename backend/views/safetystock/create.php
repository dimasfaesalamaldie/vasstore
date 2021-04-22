<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SafetyStock */

$this->title = 'Buat Data Safety Stock';
$this->params['breadcrumbs'][] = ['label' => 'Safety Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="safety-stock-create" style="width:80%;margin:auto;">

    <h1 align='center'><?= Html::encode($this->title) ?></h1>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
