<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Reset Password</h3>
              </div>
              <div class="title_right">
              <div class="actionbtns">
  <a class="btn btn-primary" href="<?=base_url();?>/<?=$logoUrl;?>"><i class="fa fa-arrow-left"></i> BACK</a>                 
           </div>

              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                <?php //if(isset($validation)){ print_r($validation->getErrors());} ?>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" action="<?php echo base_url();?>/<?=$uri;?>/reset_password" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                      <input type="hidden" name="id" value="<?=$editdata['id'];?>"  >
                      <?= csrf_field(); ?>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">New Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="new_password" name="new_password" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('new_password',$editdata['new_password']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-md-6">
                      <?php if(isset($validation) && $validation->getError('new_password')) {?>
                          <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('new_password'); ?>
                          </div>
                      <?php }?>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Confirm New Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="confirm_password" name="confirm_password" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('confirm_password',$editdata['confirm_password']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-md-6">
                      <?php if(isset($validation) && $validation->getError('confirm_password')) {?>
                        <div class='alert alert-danger mt-2'>
                          <?= $error = $validation->getError('confirm_password'); ?>
                            </div>
                        <?php }?>
                      </div> 

                      <div class="ln_solid"></div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <a href="<?=base_url();?>/<?=$logoUrl;?>" class="btn btn-primary">CANCEL</a>
                            <input type="submit" class="btn btn-success" name="submit" value="SAVE">
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
