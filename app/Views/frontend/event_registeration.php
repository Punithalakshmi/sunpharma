<div class="bg-primary-gradient"><section class="heroInner" style="background: #fff url(<?=base_url();?>/frontend/assets/img/slide4.jpg) center left no-repeat;">
        <div class="container">
            <h1 class="fs-1 fw-bold text-capitalize fw-normal p-3 m-0 d-inline-block" style="color: var(--theme-orange);">Registration</h1>
        </div>
    </section>
<section class="py-5">
        <div class="container">
            <div class="row">
<div class="registration-form">
           <form id="eventRegistration" action="<?php echo base_url();?>/event/registration" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                
           <div class="form-group mb-3">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Firstname <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="firstname" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('firstname',$editdata['firstname']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      
                      <div class="form-group mb-3">
                      <?php if(isset($validation) && $validation->getError('firstname')) {?>
                          <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('firstname'); ?>
                          </div>
                      <?php }?>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group mb-3">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Lastname <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="lastname" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('lastname',$editdata['lastname']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      
                      <div class="form-group mb-3">
                      <?php if(isset($validation) && $validation->getError('lastname')) {?>
                          <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('lastname'); ?>
                          </div>
                      <?php }?>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group mb-3">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="email" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('email',$editdata['email']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      
                      <div class="form-group mb-3">
                      <?php if(isset($validation) && $validation->getError('email')) {?>
                          <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('email'); ?>
                          </div>
                      <?php }?>
                      </div>
                      <div class="clearfix"></div>
                      
                      <div class="form-group mb-3">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Phone <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="phone" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('phone',$editdata['phone']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      
                      <div class="form-group mb-3">
                      <?php if(isset($validation) && $validation->getError('phone')) {?>
                          <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('phone'); ?>
                          </div>
                      <?php }?>
                      </div>
                      
                      <div class="clearfix"></div>
                     
                      <div class="form-group mb-3">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="address" oninput="auto_grow(this)" class="form-control"><?=$editdata['address'];?></textarea>
                        </div>
                      </div>

                     

                      <div class="clearfix"></div>
                      <div class="form-group mb-3">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Registration No:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <p>
                            <input type="text" readonly name="registeration_no" class="form-control col-md-7 col-xs-12" readonly value="<?php echo set_value('registeration_no',$editdata['registeration_no']);?>">
                           </p>
                          </div>
                        </div>
                      </div>
                     
                     
                      <div class="ln_solid"></div>
                      
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> </label>

                          <div class="col-xs-12">
                            <input type="reset" class="btn btn-primary mb-3" name="reset" value="RESET">
                            <input type="submit" class="btn btn-success mb-3" name="submit" value="SUBMIT">
                          </div>
                        </div>

                    </form>
                  </div>  
                </div>
                </div>
                </section>


</div>  