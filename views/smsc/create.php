<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Smsc */

$this->title = 'Create Smsc';
$this->params['breadcrumbs'][] = ['label' => 'Smscs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smsc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
