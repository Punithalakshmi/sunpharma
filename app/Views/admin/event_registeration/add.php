<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add/Modify Registration</h3>
              </div>
            </div>

            <div class="actionbtns">
  			<a class="btn btn-primary" href="<?=base_url();?>/admin/eventregisteration"><i class="fa fa-arrow-left"></i> BACK</a>                  
           </div>



            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                
                  <div class="x_content">
                    <br />
                    <form id="categoryForm" action="<?php echo base_url();?>/admin/eventregisteration/add" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                      <input type="hidden" name="id" value="<?=$editdata['id'];?>"  >
                      <?= csrf_field(); ?>
                      <div class="clearfix"></div>
                     <!-- <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Event</label>
                        <div class="col-md-6">
                          <select class="select2_single form-control col-md-7 col-xs-12" name="event_type" tabindex="-1" >
                            <option value=""></option>
                            <?php //if(is_array($event_categories)):
                                   // foreach($event_categories as $rvalue): ?>
                            <option value="<?//$rvalue['id'];?>" <?//set_select('event_type',$rvalue['id'],(isset($editdata['event_type']) && ($editdata['event_type']==$rvalue['id']))?true:false);?>><?//$rvalue['event_type'];?></option>
                            <?php //endforeach;
                                 // endif;
                                  ?>
                          </select>
                        </div>
                      </div>-->
                      <div class="clearfix"></div>          
                      <div class="form-group col-md-6">
                      <?php if(isset($validation) && $validation->getError('event_type')) {?>
                        <div class='alert alert-danger mt-2'>
                          <?= $error = $validation->getError('event_type'); ?>
                            </div>
                        <?php }?>
                      </div>
                     
                      <div class="clearfix"></div>   
    
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
                          <input type="text" id="first-name" name="phone" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('phone',(isset($editdata['phone']) && ($editdata['phone']!='2147483647'))?$editdata['phone']:"");?>">
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

                      <div class="form-group mb-3">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Participation Mode 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="radio" name="participation_mode" class="flat" value="Onsite" <?php echo set_radio('participation_mode','Onsite',(isset($editdata['participation_mode']) && ($editdata['participation_mode']=='Onsite'))?'checked':'');?> > On-site
                        &nbsp;&nbsp;<input type="radio" name="participation_mode" class="flat" value="Online" <?php echo set_radio('participation_mode','Online',(isset($editdata['participation_mode']) && ($editdata['participation_mode']=='Online'))?'checked':'');?> > Online
                        </div>
                      </div>                      
                     <div class="clearfix"></div>
               
                      <div class="form-group mb-3">
                      <?php if(isset($validation) && $validation->getError('participation_mode')) {?>
                          <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('participation_mode'); ?>
                          </div>
                      <?php }?>
                      </div>


                     <!-- <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Registration No:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <p>
                            <input type="text" name="registeration_no" class="form-control col-md-7 col-xs-12" readonly value="<?php //echo set_value('registeration_no',$editdata['registeration_no']);?>">
                           </p>
                          </div>
                        </div>
                      </div> -->
                     
                     
                      <div class="ln_solid"></div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            				<a href="<?=base_url();?>/admin/eventregisteration" class="btn btn-primary">CANCEL</a>
                            <input type="submit" class="btn btn-success" name="submit" value="SAVE">
                          </div>
                        </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
