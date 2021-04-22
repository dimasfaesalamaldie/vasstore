<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

if (empty($model->aktif)) {
    $model->aktif = 1;
}

/* @var $this yii\web\View */
/* @var $model app\models\Staff */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'readOnly' => !$model->isNewRecord]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_telp')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'aktif')->checkBox(['value' => 1])?>

    <?= $form->field($model, 'access_token')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'auth_key')->hiddenInput()->label(false) ?>


    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
