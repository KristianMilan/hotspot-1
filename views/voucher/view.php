<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Voucher */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ваучеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="voucher-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <input type="button" onclick="printDiv('printableArea')" value="Распечатать" class="btn btn-primary" />
    </p>
<div id="printableArea">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'password',
            'time:datetime',
        ],
    ]) ?>
</div>
</div>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>