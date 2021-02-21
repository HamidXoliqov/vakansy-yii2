<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app','Page not found');
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="text-center mt-4">
                <h1 class="display-1">404</h1>
                <p class="lead">This requested URL was not found on this server.</p>
                <a href="<?=Url::to(['/'])?>">
                    <i class="fas fa-arrow-left mr-1"></i>Return to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
