<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Employe */

$this->title = Yii::t('app', 'Create Employe');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Employes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<main>
    <div class="container-fluid">
        <div class="employe-create">

            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
                'user' => $user,
            ]) ?>

        </div>
    </div>
</main>