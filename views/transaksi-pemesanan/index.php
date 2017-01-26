<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransaksiPemesananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaksi Pemesanans';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header">
    <h1>
        Transaksi Pemesanan
    </h1>
    <?=
    Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ])
    ?>
</section>


<section class="content">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Transaksi Pemesanan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tanggal',
            'total',
            'id_admin',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</section>