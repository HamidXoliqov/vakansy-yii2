<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$this->title = Yii::t('app','Sign up');

?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Create Account</h3>
                </div>
                <div class="card-body">
                    <?php  $form = ActiveForm::begin();?>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputFirstName">
                                        First Name
                                    </label>
                                    <?= $form->field($model, 'firstname')->textInput(['class' => 'form-control py-4','placeholder'=>'Enter first name'])->label(false); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputLastName">
                                        Last Name
                                    </label>
                                    <?= $form->field($model, 'lastname')->textInput(['class' => 'form-control py-4','placeholder'=>'Enter last name'])->label(false); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1" for="inputEmailAddress">
                                Email
                            </label>
                            <?= $form->field($model, 'email')->textInput(['class' => 'form-control py-4','placeholder'=>'Enter email address'])->label(false); ?>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputPassword">
                                        Password
                                    </label>
                                    <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control py-4','placeholder'=>'Enter password'])->label(false); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputConfirmPassword">
                                        Confirm Password
                                    </label>
                                    <?= $form->field($model, 'retypePassword')->passwordInput(['class' => 'form-control py-4','placeholder'=>'Confirm password'])->label(false); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4 mb-0">
                            <button type="submit" class="btn btn-primary btn-block">
                                Create Account
                            </button>
                        </div>
                    <?php ActiveForm::end();?>
                </div>
                <div class="card-footer text-center">
                    <div class="small">
                        <a href="<?=Url::to('login')?>">Have an account? Go to login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>