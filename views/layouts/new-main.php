<?php
use yii\helpers\Html;
use app\assets\LteAsset;

LteAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->

            <a href="#" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b>PT</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Aplikasi </b>APOTIK</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= Yii::$app->request->baseUrl ?>/lte/avatar.png" class="user-image" >
                                <span class="hidden-xs"><?= Yii::$app->user->identity->username ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?= Yii::$app->request->baseUrl ?>/lte/avatar.png" class="img-circle" >

                                    <p>
                                        <?= Yii::$app->user->identity->username ?>
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <?=
                                        Html::beginForm(['/site/profile'], 'post', ['class' => 'navbar-form'])
                                        . Html::submitButton(
                                            'Profile',
                                            ['class' => 'btn btn-default btn-flat']
                                        )
                                        . Html::endForm()
                                        ?>
                                    </div>
                                    <div class="pull-right">
                                        <?=
                                        Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                                        . Html::submitButton(
                                            'Keluar',
                                            ['class' => 'btn btn-default btn-flat']
                                        )
                                        . Html::endForm()
                                        ?>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <?= Html::a(
                            '<img src="'.Yii::$app->request->baseUrl.'/lte/avatar.png" class="img-circle" >',
                            ['/site/profile'],
                            ['data-method' => 'post', 'class' => 'pull-left image']
                    ) ?>
                    <div class="pull-left info">
                        <p><?= Yii::$app->user->identity->username ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                    </div>
                </form>
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="treeview">
                        <?= Html::a(
                            '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Beranda',
                            ['/site/index'],
                            ['data-method' => 'post', 'class' => 'fa fa-dashboard']
                        ) ?>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-pie-chart"></i>
                            <span>&nbsp;&nbsp;&nbsp;Transaksi</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php
                                if(Yii::$app->user->identity->id_role==1){
                                    ?>
                                    <li>
                                        <?= Html::a(
                                            ' &nbsp;&nbsp;&nbsp;&nbsp;Pemesanan',
                                            ['transaksi-pemesanan/index'],
                                            ['data-method' => 'post', 'class' => 'fa fa-circle-o']
                                        ) ?>

                                    </li>
                                    <li>
                                        <?= Html::a(
                                            ' &nbsp;&nbsp;&nbsp;&nbsp;Penjualan',
                                            ['/site/penjualan'],
                                            ['data-method' => 'post', 'class' => 'fa fa-circle-o']
                                        ) ?>

                                    </li>

                                    <?php
                                }
                                elseif(Yii::$app->user->identity->id_role==2) {
                                    ?>
                                    <li>
                                        <?= Html::a(
                                            ' &nbsp;&nbsp;&nbsp;&nbsp;Pemesanan',
                                            ['transaksi-pemesanan/index'],
                                            ['data-method' => 'post', 'class' => 'fa fa-circle-o']
                                        ) ?>

                                    </li>

                                    <?php
                                } elseif(Yii::$app->user->identity->id_role==3) {
                                    ?>
                                    <li>
                                        <?= Html::a(
                                            ' &nbsp;&nbsp;&nbsp;&nbsp;Penjualan',
                                            ['/site/penjualan'],
                                            ['data-method' => 'post', 'class' => 'fa fa-circle-o']
                                        ) ?>

                                    </li>
                            <?php
                                }

                            ?>

                        </ul>
                    </li>

                    <?php
                    if(Yii::$app->user->identity->id_role==1){
                        ?>
                        <li class="treeview">
                            <?= Html::a(
                                '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Petugas',
                                ['/petugas/index'],
                                ['data-method' => 'post', 'class' => 'fa fa-edit']
                            ) ?>
                        </li>

                        <?php

                    }
                    ?>


                    <li class="treeview">
                        <?= Html::a(
                            ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Barang',
                            ['/site/barang'],
                            ['data-method' => 'post', 'class' => 'fa fa-table']
                        ) ?>
                    </li>

                    <li>
                        <?= Html::a(
                            ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Report',
                            ['/report/index'],
                            ['data-method' => 'post', 'class' => 'fa fa-book']
                        ) ?>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">
            <?php $this->beginBody() ?>
                <?= $content ?>
            <?php $this->endBody() ?>
        </div>

        <footer class="main-footer">
<!--            <div class="pull-right hidden-xs">-->
<!--                <b>Version</b> 2.3.7-->
<!--            </div>-->
            <strong>Copyright &copy; 2016 <a href="http://devills.com">Devilss Developer</a>.</strong> All rights
            reserved.
        </footer>
        <!-- Control Sidebar -->

    </div>

</body>
</html>
<?php $this->endPage() ?>


