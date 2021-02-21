<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EmployeStatus */

$this->title = Yii::t('app', 'Create Employe Status');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Employe Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<main>
    <div class="container-fluid">
        <div class="employe-status-create">

            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</main>