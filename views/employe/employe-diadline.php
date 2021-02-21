<?php

$this->title = Yii::t('app','Employe diadline');
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Employe history</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active">Employe history</li>
        </ol>
			<div class="card mb-4">
	            <div class="card-header"><i class="fas fa-table mr-1"></i>
	                DataTable Employe history all
	            </div>
	            <div class="card-body">
	                <div class="table-responsive">
	                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	                        <thead>
	                            <tr>
	                                <th>Employe</th>
	                                <th>Status</th>
	                                <th>comment</th>
	                                <th>Diadline</th>
	                                <th>Created at</th>
	                            </tr>
	                        </thead>
	                        <?php foreach($history as $key=>$value):?>
	                        <tbody>
	                            <tr>
	                                <td><?=$value->employe->lastname?></td>
	                                <td><?=$value->status->name?></td>
	                                <td><?=$value->comment?></td>
	                                <td><?=date('Y-m-d', $value->diadline_time) ?></td>
	                                <td><?=date('Y-m-d', $value->create_at) ?></td>
	                            </tr>
	                            <tr>
	                        </tbody>
	                        <?php endforeach?>
	                    </table>
	                </div>
	            </div>
	        </div>
    </div>
</main>