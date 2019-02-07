<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Aps */

$this->title = 'Создание точки';
$this->params['breadcrumbs'][] = ['label' => 'Aps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aps-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
