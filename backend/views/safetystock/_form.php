<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Barang;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\SafetyStock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="safety-stock-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'sku_barang')->dropDownList(
        ArrayHelper::map(Barang::find()->andWhere(['aktif'=>1])->asArray()->all(), 'sku', 'nama'),
        ['prompt' => ' - Pilih Sepatu -']
    )
    ?>

    <?= $form->field($model, 'max')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'rerata')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'stock')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'safety_stock')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'leadtime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
