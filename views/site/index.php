<?php

/* @var $this yii\web\View */

$this->title = 'Employe project';
if ($user->role == 'admin') {
    $role = true;
} else {
    $role = false;
}
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Holati: Yangi</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body">Holati: Intervyu belgilangan</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Holati: Qabul qilingan</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Holati: Qabul qilinmagan</div>
                </div>
            </div>
        </div>
        <?php if($role):?>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>
                DataTable Employee all
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Lastname</th>
                                <th>Address</th>
                                <th>Country</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Created at</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Lastname</th>
                                <th>Address</th>
                                <th>Country</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Created at</th>
                            </tr>
                        </tfoot>
                        <?php foreach($employes as $value):?>
                        <tbody>
                            <tr>
                                <td><?=$value->lastname?></td>
                                <td><?=$value->address?></td>
                                <td><?=$value->country_of_origin?></td>
                                <td><?=$value->phone_number?></td>
                                <td><?=$value->email?></td>
                                <td><?=$value->status?></td>
                                <td><?=date('Y-m-d', $value->created) ?></td>
                            </tr>
                            <tr>
                        </tbody>
                        <?php endforeach?>
                    </table>
                </div>
            </div>
        </div>
        <?php endif?>
    </div>
</main>