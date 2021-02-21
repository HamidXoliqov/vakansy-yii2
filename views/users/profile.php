<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('app','Profile user');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">User profile</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active">User profile</li>
        </ol>
        <div class="user-view">
            <?= DetailView::widget([
                'model' => $user,
                'attributes' => [
                    'id',
                    'firstname',
                    'lastname',
                    'email',
                    'role',
                    [
                        'attribute' => 'status',
                        'label' => Yii::t('app', 'Status'),
                        'value' => function ($model) {
                            return ($model->status) ? 'Active' : 'In active';
                        },
                    ],
                    [
                        'attribute' => 'created',
                        'label' => Yii::t('app', 'Created at'),
                        'value' => function ($model) {
                            return date('Y-m-d H:i:s', $model->created);
                        },
                    ],
                    [
                        'attribute' => 'updated',
                        'label' => Yii::t('app', 'Updated at'),
                        'value' => function ($model) {
                            return date('Y-m-d H:i:s', $model->updated);
                        },
                    ],

                ],
            ]) ?>

        </div>
    </div>
</main>