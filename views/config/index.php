<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Configs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'unifi_url:url',
            'unifi_login',
            'unifi_pass',
            'session_time',
            'speed_up',
            'speed_down',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
