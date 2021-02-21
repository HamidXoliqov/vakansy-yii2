<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app','Employe user one');
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Employe</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active">Employe</li>
            	<a href="#" style="margin-left: 75%" class="btn btn-outline-success btn-xs" data-toggle="modal" data-target="#createEmploye">
            		Create
            	</a>
	        </ol>
			<div class="card mb-4">
	            <div class="card-header"><i class="fas fa-table mr-1"></i>
	                DataTable Employe all
	            </div>
	            <div class="card-body">
	                <div class="table-responsive">
	                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	                        <thead>
	                            <tr>
	                                <th>Last name</th>
	                                <th>Email</th>
	                                <th>Address</th>
	                                <th>Country</th>
	                                <th>Status</th>
	                                <th>Created at</th>
	                                <th>Diadline</th>
	                            </tr>
	                        </thead>
	                        <?php if(!empty($employe)):?>

	                        <?php foreach($employe as $key=>$value):?>
	                        <tbody>
	                            <tr>
	                                <td><?=$value->lastname?></td>
	                                <td><?=$value->email?></td>
	                                <td><?=$value->address?></td>
	                                <td><?=$value->country_of_origin?></td>
	                                <td><?=$value->statusName->name?></td>
	                                <td><?=date('Y-m-d', $value->created) ?></td>
	                                <td>
	                                	<button type="button" class="btn btn-outline-success btn-xs status_button" data-toggle="modal" data-target="#employeDiadline" data-id="<?=$value->id?>">
                                  		<i class="fa fa-check" aria-hidden="true"></i>
                                		</button>
	                                </td>
	                            </tr>
	                            <tr>
	                        </tbody>
	                        <?php endforeach?>
	                        <?php else:?>
	                        	<p align="center">
	                        		Item not found
	                        	</p>
	                        <?php endif?>
	                    </table>
	                </div>
	            </div>
	        </div>
    </div>
</main>

<!-- Create ariza -->
<!-- Modal -->
<div class="modal fade" id="createEmploye" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 60%!important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Employee Created</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
            <?php $form = ActiveForm::begin([
              'action' => Url::to(['employe/employe-one','id'=>$user->getId()])
            ]); ?>
                <?= $form->field($model, 'user_id')->hiddenInput(['value' => $user->getId()])->label(false); ?>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'country_of_origin')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true,'data-mask'=>"+998000000000",'data-mask-selectonfocus'=>true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'age')->textInput() ?>
                </div>
                <div class="col-md-12">
                    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
          </div>
          <?php ActiveForm::end(); ?>               

    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="employeDiadline" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Employee Diadline</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Status:</label>
                        <input type="text" class="form-control" value="" disabled="disabled" id="employe_status">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">
                            Diadline time:</label>
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" value="" disabled="disabled" id="employe_date">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    	<label for="recipient-name" class="col-form-label">
                            Comment:</label>
                            <textarea class="form-control" value="" disabled="disabled" id="employe_comment">
                            </textarea>
                    </div> 
                </div>
            </div>                
          </div>
          <div class="modal-footer">
          	<p style="margin-right: 30%; color: blue" id="employe_created">
          		
          	</p>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
    </div>
  </div>
</div>

<?php
    $this->registerJS('
        $(".status_button").click(function() {
            var id = $(this).data("id");
         	$.get("/web/employe/employe-status-data",{id:id},function(response){       
         		if(response){
         			var json = $.parseJSON(response); 
       				$("#employe_status").val(json.status);
       				$("#employe_date").val(json.diadline);
       				$("#employe_comment").val(json.comment);
       				$("#employe_created").html("Created: "+json.created);
         		}
            
        	}); 
        });
    ');
?>