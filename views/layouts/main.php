<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
$user = Yii::$app->user->identity;
if ($user->role == 'user') {
    $role = true;
} else {
    $role = false;
}

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="sb-nav-fixed">
    <?php $this->beginBody() ?>
    <!-- // display success message -->

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="<?= Url::to(['/']) ?>">
            <?= Yii::t('app', 'Yii2 project') ?>
        </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button><!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?=Url::to(['users/profile','id'=>$user->getId()])?>">
                        <?=Yii::t('app','Profile')?>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?=Url::to(['admin/logout'])?>">
                        <?=Yii::t('app','Logout')?>
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <div class="sb-sidenav-menu-heading">Core</div>
                        <?php if($role):?>
                        <a class="nav-link" href="<?= Url::to(['/']) ?>">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <?= Yii::t('app', 'Dashboard') ?>
                        </a>
                        <a class="nav-link" href="<?= Url::to(['employe/employe-one','id'=>$user->getId()])?>">
                            <div class="sb-nav-link-icon">
                                <i class="fa fa-user"></i>
                            </div>
                            <?= Yii::t('app', 'Employe') ?>
                        </a>
                        <?php else:?>
                        <a class="nav-link" href="<?= Url::to(['/']) ?>">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <?= Yii::t('app', 'Dashboard') ?>
                        </a>
                        <div class="sb-sidenav-menu-heading">
                            <?= Yii::t('app', 'Settings') ?>
                        </div>
                        <a class="nav-link" href="<?= Url::to(['/users']) ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            <?= Yii::t('app', 'Users') ?>
                        </a>
                        <a class="nav-link" href="<?= Url::to(['/employe']) ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            <?= Yii::t('app', 'Employes') ?>
                        </a>
                         <a class="nav-link" href="<?= Url::to(['/employe/employe-diadline']) ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            <?= Yii::t('app', 'Employe status history') ?>
                        </a>
                        <a class="nav-link" href="<?= Url::to(['/employe-status']) ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            <?= Yii::t('app', 'Employe status') ?>
                        </a>                        
                        <?php endif?>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <?php if (Yii::$app->session->hasFlash('success')) : ?>
                <div class="alert alert-success alert-dismissable" style="margin: 10px;">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php endif; ?>

            <!-- // display error message -->
            <?php if (Yii::$app->session->hasFlash('error')) : ?>
                <div class="alert alert-danger alert-dismissable" style="margin: 10px;">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <?= Yii::$app->session->getFlash('error') ?>
                </div>
            <?php endif; ?>
            <?= $content ?>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2019</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>