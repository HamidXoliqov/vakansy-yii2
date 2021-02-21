<?php

use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<main>
    <div class="container-fluid">
        <div class="user-index">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php // echo $this->render('_search', ['model' => $searchModel]); 
            ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'firstname',
                    'lastname',
                    'email',
                    'role',
                    [
                        'attribute' => 'status',
                        'label' => Yii::t('app', 'Status'),
                        'value' => function ($model) {
                            return ($model->status)?'Active':'In active';
                        },
                    ],
                    [
                        'attribute' => 'created',
                        'label' => Yii::t('app', 'Created at'),
                        'value' => function ($model) {
                            return date('Y-m-d H:i:s',$model->created);
                        },
                    ],

                    [
                        'class' => ActionColumn::class,
                        'template' => '{view} {update} {delete} ',
                        'contentOptions' => ['style' => 'width:200px;'],
                        'header' => Yii::t('app', "Action"),
        
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<i class="fa fa-eye ml-1"></i>',  $url, [
                                    'class' => 'btn btn-outline-info btn-xs',
                                ]);
                            },
                            'update' => function ($url, $model) {
                                return Html::a('<i class="fa fa-edit ml-1"></i>',  $url, [
                                    'class' => 'btn btn-outline-primary btn-xs',
                                ]);
                            },
                            'delete' => function ($url) {
                                return Html::a('<i class="fa fa-trash ml-1"></i>', $url, [
                                    'data' => [
                                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                        'method' => 'post',
                                    ],
                                    'title' => Yii::t('app', 'Delete'),
                                    'class' => "btn btn-xs btn-outline-danger delete-button",
                                    'data-id' => Yii::$app->language
                                ]);
                            },
                        ]
                    ],
                ],
            ]); ?>


        </div>
    </div>
</main>