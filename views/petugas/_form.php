<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\base\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="content-header">

</section>

<section class="content">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_role')->textInput()->hiddenInput(['value'=> 2])->label(false) ?>

    <?= $form->field($model, 'id_role')->dropDownList(
        ['1' => 'Admin', '2' => 'Apoteker', '3' => 'Kasir']
    ); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</section>
