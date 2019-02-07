<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Aps */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aps-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mac')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'place_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
