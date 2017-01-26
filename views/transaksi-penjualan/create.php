<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;


/* @var $this yii\web\View */
/* @var $model app\models\base\TransaksiPenjualan */

$this->title = 'Create Transaksi Penjualan';
$this->params['breadcrumbs'][] = ['label' => 'Transaksi Penjualans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content-header">
    <h1>
        Tambah Penjualan
    </h1>
    <?=
    Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ])
    ?>
</section>


<section class="content">

    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetails' => $modelsDetails,
        'barangs' => $barangs
    ]) ?>

</section>
