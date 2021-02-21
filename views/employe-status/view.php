<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EmployeStatus */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Employe Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<main>
    <div class="container-fluid">
        <div class="employe-status-view">

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
                    'name',
                    [
                        'attribute' => 'created',
                        'label' => Yii::t('app', 'Created at'),
                        'value' => function ($model) {
                            return date('Y-m-d H:i:s',$model->created);
                        },
                    ],
                    [
                        'attribute' => 'updated',
                        'label' => Yii::t('app', 'Updated at'),
                        'value' => function ($model) {
                            return date('Y-m-d H:i:s',$model->updated);
                        },
                    ]
                ],
            ]) ?>

        </div>
    </div>
</main>