
<br><?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SmscSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статистика авторизаций';
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="smsc-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'mac',
            'phone',
            'code',
            'ap_mac',
            'status',
            'ip',
            'time:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
