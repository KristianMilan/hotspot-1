<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Config */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="config-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'unifi_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unifi_login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unifi_pass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'session_time')->textInput() ?>

    <?= $form->field($model, 'speed_up')->textInput() ?>

    <?= $form->field($model, 'speed_down')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
