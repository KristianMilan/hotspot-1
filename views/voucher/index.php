<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VoucherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ваучеры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="voucher-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <p>
        <?= Html::a('Создать ваучер', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <small>Ваучеры автоматически удаляются после истечения времени</small>
    <br><br>
    <input type="button" onclick="printDiv('printableArea')" value="Распечатать ваучеры" class="btn btn-primary" />
    <br><br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'password',
            'time:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <div style="display: none" id="printableArea">
        <?php foreach($v as $vo):?>
        <table style="width: 100%;" border="1">
            <thead>
                <tr>
                    <th style="padding: 4px">Пароль</th>
                    <th style="padding: 4px">Время жизни (до)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 4px"><?=$vo['password']?></td>
                    <td style="padding: 4px"><?=date('d-m-Y h:i:s',$vo['time'])?></td>
                </tr>
            </tbody>
        </table>
        <br>
        <?php endforeach;?>
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