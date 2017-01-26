<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\base\TransaksiPemesanan */

$this->title = 'Create Transaksi Pemesanan';
$this->params['breadcrumbs'][] = ['label' => 'Transaksi Pemesanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header">
    <h1>
        Tambah Pesanan
    </h1>
    <?=
    Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ])
    ?>
</section>


<section class="content">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetails' => $modelsDetails,
        'barangs' => $barangs
    ]) ?>

</section>
