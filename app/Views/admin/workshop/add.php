<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add/Modify Event</h3>
              </div>
            </div>

            <div class="actionbtns">
   <a class="btn btn-primary" href="<?=base_url();?>/admin/workshops"><i class="fa fa-arrow-left"></i> BACK</a>               
           </div>

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                
                  <div class="x_content">
                    <br />
                    <form id="categoryForm" action="<?php echo base_url();?>/admin/workshops/add" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                      <input type="hidden" name="id" value="<?=$editdata['id'];?>"  >
                      <?= csrf_field(); ?>
                      
    
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Firstname <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="firstname" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('firstname',$editdata['firstname']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      
                      <div class="form-group col-md-6">
                      <?php if(isset($validation) && $validation->getError('firstname')) {?>
                          <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('firstname'); ?>
                          </div>
                      <?php }?>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Lastname <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="lastname" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('lastname',$editdata['lastname']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      
                      <div class="form-group col-md-6">
                      <?php if(isset($validation) && $validation->getError('lastname')) {?>
                          <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('lastname'); ?>
                          </div>
                      <?php }?>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="email" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('email',$editdata['email']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      
                      <div class="form-group col-md-6">
                      <?php if(isset($validation) && $validation->getError('email')) {?>
                          <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('email'); ?>
                          </div>
                      <?php }?>
                      </div>
                      <div class="clearfix"></div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Phone <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="phone" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('phone',$editdata['phone']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      
                      <div class="form-group col-md-6">
                      <?php if(isset($validation) && $validation->getError('phone')) {?>
                          <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('phone'); ?>
                          </div>
                      <?php }?>
                      </div>
                      
                      <div class="clearfix"></div>
                     
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="address"><?=$editdata['address'];?></textarea>
                        </div>
                      </div>

                      <div class="clearfix"></div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Invitation File Upload 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="event_document" readonly class="form-control col-md-7 col-xs-12" value="<?php echo set_value('registration_link',$editdata['registration_link']);?>">
                        </div>
                      </div>
                      
                      
                      <div class="clearfix"></div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Year</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <p>
                            <input type="text" readonly id="year" name="workshop_year" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('year',$editdata['year']);?>">
                           </p>
                          </div>
                        </div>
                      </div>


                      
                      <div class="clearfix"></div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Start Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <p>
                            <input type="text" id="single_cal3" name="start_date" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('start_date',$editdata['start_date']);?>">
                           </p>
                          </div>
                        </div>
                      </div>

                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">End Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <p>
                            <input type="text" name="end_date" id="single_cal2" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('end_date',$editdata['end_date']);?>">
                           </p>
                          </div>
                        </div>
                      </div>
                     
                     
                      <div class="ln_solid"></div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <a href="<?=base_url();?>/admin/workshops" class="btn btn-primary">CANCEL</a> 
                            <input type="submit" class="btn btn-success" name="submit" value="SUBMIT">                          </div>
                        </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
