<?php

use app\models\Employe;
use app\models\EmployeStatus;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $searchModel app\models\EmployeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Employes');
$this->params['breadcrumbs'][] = $this->title;

?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>

<main>
    <div class="container-fluid">
        <div class="employe-index">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a(Yii::t('app', 'Create Employe'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php // echo $this->render('_search', ['model' => $searchModel]); 
            ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'lastname',
                    'address',
                    'country_of_origin',
                    [
                        'attribute' => 'employe_status_id',
                        'label' => Yii::t('app', 'Status'),
                        'content' => function ($model) {
                            return $model->getStatus();
                        },
                        // 'filter' => Select2::widget([
                        //     'model' => $searchModel,
                        //     'attribute' => 'in',
                        //     'data' => ArrayHelper::map(EmployeStatus::find()
                        //     ->all(), 'id', 'name'),
                        //     'size' => Select2::SIZE_SMALL,
                        //     'options' => [
                        //         'placeholder' => Yii::t('app', 'Select'),
                        //         'multiple' => true,
                        //     ],
                        //     'pluginOptions' => [
                        //         'allowClear' => true,
                        //     ],
                        // ]),
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
                        'template' => '{status} {view} {update} {delete} ',
                        'contentOptions' => ['style' => 'width:230px;'],
                        'header' => Yii::t('app', "Action"),
        
                        'buttons' => [
                            'status' => function ($url, $model) {
                                return '<button type="button" class="btn btn-outline-success btn-xs status_button" data-toggle="modal" data-target="#exampleModalCenter" data-id="'.$model['id'].'">
                                  <i class="fa fa-check" aria-hidden="true"></i>
                                </button>';
                            },
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
                                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item ?'),
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

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Employee status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <?php $form = ActiveForm::begin([
            'action' => Url::to(['employe/status'])
        ]); ?>
          <div class="modal-body">
            <input type="hidden" name="Employe[id]" value="" id="employe_id">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Status:</label>
                            <select class="form-control" name="Employe[status_id]">
                              <option value="0">Select status</option>
                                <? foreach(Employe::getListModal() as $key=>$value):?>
                                    <option value="<?=$value->id?>"><?=$value->name?></option>
                                <? endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">
                                Date time:</label>
                            <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control" name="EmployeHistory[diadline_time]" autocomplete="off">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Comment tex" name="EmployeHistory[comment]">
                                
                            </textarea>
                        </div> 
                    </div>
                </div>    
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        <?php ActiveForm::end(); ?>     
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>


<?php
    $this->registerJS('
        $(".status_button").click(function() {
            var id = $(this).data("id");
            $("#employe_id").val(id);
            console.log(id);
        });

        $(".datepicker").datepicker({
            format: "mm/dd/yyyy",
            todayHighlight: true,
        });
    ');
?>