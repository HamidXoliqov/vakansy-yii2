<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Employe */

$this->title = $model->lastname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Employes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<main>
    <div class="container-fluid">
        <div class="employe-view">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'lastname',
                    'firstname',
                    'address',
                    'country_of_origin',
                    'email',
                    'phone_number',
                    'age',
                    [
                        'attribute' => 'hired',
                        'label' => Yii::t('app', 'Hired'),
                        'value' => function ($model) {
                            return ($model->hired)?'True':'False';
                        },
                    ],
                    [
                        'attribute' => 'employe_status_id',
                        'label' => Yii::t('app', 'Status'),
                        'value' => function ($model) {
                            return $model->statusName->name;
                        },
                    ],
                    [
                        'attribute' => 'updated',
                        'label' => Yii::t('app', 'Updated'),
                        'value' => function ($model) {
                            return date('Y-m-d H:i:s',$model->updated);
                        },
                    ],
                    [
                        'attribute' => 'created',
                        'label' => Yii::t('app', 'Created'),
                        'value' => function ($model) {
                            return date('Y-m-d H:i:s',$model->updated);
                        },
                    ],
                ],
            ]) ?>

        </div>
    </div>
</main>