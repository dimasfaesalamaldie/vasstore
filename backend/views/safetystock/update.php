<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SafetyStock */

$this->title = 'Update Safety Stock';
$this->params['breadcrumbs'][] = ['label' => 'Safety Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_safety, 'url' => ['view', 'id' => $model->id_safety]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="safety-stock-update" style="width:80%;margin:auto;">

    <h1 align='center'><?= Html::encode($this->title) ?></h1>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
