<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SafetyStockSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="safety-stock-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_safety') ?>

    <?= $form->field($model, 'sku_barang') ?>

    <?= $form->field($model, 'max') ?>

    <?= $form->field($model, 'rerata') ?>

    <?= $form->field($model, 'leadtime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
