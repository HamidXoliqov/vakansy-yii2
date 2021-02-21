<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = Yii::t('app','Sign in');
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Login</h3>
                </div>
                <div class="card-body">
                    <?php  $form = ActiveForm::begin();?>
                        <div class="form-group">
                            <label class="small mb-1" for="inputEmailAddress">
                                Email
                            </label>
                            <?= $form->field($model, 'email')->textInput(['class' => 'form-control py-4','placeholder'=>'Enter email address'])->label(false); ?>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1" for="inputPassword">
                                Password
                            </label>
                            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control py-4','placeholder'=>'Enter password'])->label(false); ?>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox"><input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" /><label class="custom-control-label" for="rememberPasswordCheck">Remember password</label></div>
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a class="small" href="#">Forgot Password?</a>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    <?php ActiveForm::end();?>
                </div>
                <div class="card-footer text-center">
                    <div class="small">
                        <a href="<?=Url::to('signup')?>">Need an account? Sign up!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>