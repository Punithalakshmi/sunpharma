<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add/Modify User</h3>
              </div>

              </div>

              <div class="actionbtns">
                <a class="btn btn-primary" href="<?=base_url();?>/admin/user">
                  <i class="fa fa-arrow-left"></i> BACK
                </a>           
              </div>


            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" action="<?php echo base_url();?>/admin/user/add" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                      <input type="hidden" name="id" value="<?=$editdata['id'];?>"  >
                      <?= csrf_field(); ?>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required" style="color:red;">*</span>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required" style="color:red;">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="last-name" name="lastname" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('lastname',$editdata['lastname']);?>">
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
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="middlename" value="<?php echo set_value('middlename',$editdata['middlename']);?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required" style="color:red;">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="email" class="form-control col-md-7 col-xs-12" type="text" name="email" value="<?php echo set_value('email',$editdata['email']);?>">
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
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Username <span class="required" style="color:red;">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="username" class="form-control col-md-7 col-xs-12" type="text" name="username" value="<?php echo set_value('username',$editdata['username']);?>">
                        </div>
                       
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-md-6">
                      <?php if(isset($validation) && $validation->getError('username')) {?>
                        <div class='alert alert-danger mt-2'>
                          <?= $error = $validation->getError('username'); ?>
                            </div>
                        <?php }?>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Password <?php if($editdata['id'] =='') {?><span class="required" style="color:red;">*</span><?php } ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password" class="form-control col-md-7 col-xs-12" type="password" name="password" value="<?php echo set_value('password',$editdata['password']);?>">
                        </div>
                       
                      </div>
                      <div class="clearfix"></div>
                      <?php if($editdata['id'] =='') {?>
                      <div class="form-group col-md-6">
                      <?php if(isset($validation) && $validation->getError('password')) {?>
                        <div class='alert alert-danger mt-2'>
                          <?= $error = $validation->getError('password'); ?>
                            </div>
                        <?php }?>
                      </div>
                      <?php } ?>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password 
                        <?php if($editdata['id'] =='') {?><span class="required" style="color:red;">*</span><?php } ?>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="confirm_password" class="form-control col-md-7 col-xs-12" type="password" name="confirm_password" value="<?php echo set_value('confirm_password',$editdata['confirm_password']);?>">
                        </div>
                       
                      </div>
                      <div class="clearfix"></div>
                      <?php if($editdata['id'] =='') {?>
                      <div class="form-group col-md-6">
                      <?php if(isset($validation) && $validation->getError('confirm_password')) {?>
                        <div class='alert alert-danger mt-2'>
                          <?= $error = $validation->getError('confirm_password'); ?>
                            </div>
                        <?php }?>
                      </div>
                      <?php } ?>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number <span class="required" style="color:red;">*</span> </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input id="phonenumber" class="form-control col-md-7 col-xs-12" type="number" name="phonenumber" value="<?php echo set_value('phonenumber',$editdata['phone']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-md-6">
                      <?php if(isset($validation) && $validation->getError('phonenumber')) {?>
                        <div class='alert alert-danger mt-2'>
                          <?= $error = $validation->getError('phonenumber'); ?>
                            </div>
                        <?php }?>
                      </div>
                        <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender 
                          <!-- <span class="required" style="color:red;">*</span>  -->
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group mt-10" data-toggle="buttons">
                            <p>
                              M: <input type="radio" class="flat" name="gender" id="genderM" value="M" <?php echo set_radio('gender','M',(isset($editdata['gender']) && ($editdata['gender']=='M'))?'checked':'');?> /> &nbsp;&nbsp;
                              F: <input type="radio" class="flat" name="gender" id="genderF" value="F" <?php echo set_radio('gender','F',(isset($editdata['gender']) && ($editdata['gender']=='F'))?'checked':'');?> />
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <!-- <div class="form-group col-md-6"> -->
                      <?php //if(isset($validation) && $validation->getError('gender')) {?>
                          <!-- <div class='alert alert-danger mt-2'>
                            <?// $error = $validation->getError('gender'); ?>
                          </div> -->
                      <?php //}?>
                      <!-- </div> -->
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth 
                             <!-- <span class="required" style="color:red;">*</span> -->
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="single_cal3" name="date_of_birth" class="date-picker form-control col-md-7 col-xs-12" type="text" value="<?php echo set_value('date_of_birth',$editdata['dob']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <!-- <div class="form-group col-md-6">
                      <?php //if(isset($validation) && $validation->getError('date_of_birth')) {?>
                          <div class='alert alert-danger mt-2'>
                            <?// $error = $validation->getError('date_of_birth'); ?>
                          </div>
                      <?php //}?>
                      </div> -->
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Role 
                          <span class="required" style="color:red;">*</span> </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="select2_single form-control" name="user_role" tabindex="-1" >
                            <option value=""></option>
                            <?php if(is_array($roles)):
                                    foreach($roles as $rvalue): // if($rvalue['id']!=2): ?>
                            <option value="<?=$rvalue['id'];?>" <?=set_select('user_role',$rvalue['id'],(isset($editdata['role']) && ($editdata['role']==$rvalue['id']))?true:false);?>><?=$rvalue['name'];?></option>
                            <?php //endif; 
					endforeach;
                                  endif;
                                  ?>
                          </select>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-md-6">
                      <?php if(isset($validation) && $validation->getError('user_role')) {?>
                          <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('user_role'); ?>
                          </div>
                      <?php }?>
                      </div>
                      <div class="clearfix"></div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-6 col-sm-6 col-xs-12 mt-10">
                          <div id="gender" class="btn-group mt-10" data-toggle="buttons">
                            <p>
                            <input type="radio" class="flat" name="status" id="statusActive" value="1" <?php echo set_radio('status','1',(isset($editdata['status']) && ($editdata['status']=='1'))?'checked':'');?> /> Active &nbsp;&nbsp;
                            <input type="radio" class="flat" name="status" id="statusInActive" value="0" <?php echo set_radio('status','0',(isset($editdata['status']) && ($editdata['status']=='0'))?'checked':'');?> /> InActive
                           </p>
                          </div>
                        </div>
                      </div>
                      <div class="clearfix"></div>          
                      <div class="form-group col-md-6">
                      <?php if(isset($validation) && $validation->getError('status')) {?>
                        <div class='alert alert-danger mt-2'>
                          <?= $error = $validation->getError('status'); ?>
                            </div>
                        <?php }?>
                      </div>
                      <div class="clearfix"></div>
                        <div id="categorySelection" class="form-group" style="display:<?=(isset($editdata['role']) && ($editdata['role'] == 1))?'block':'none';?>">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Category</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="select2_single form-control" name="category" tabindex="-1">
                              <option value=""></option>
                              <?php if(is_array($categories)):
                                      foreach($categories as $rvalue): ?>
                              <option value="<?=$rvalue['id'];?>" <?=set_select('category',$rvalue['id'],(isset($editdata['category']) && ($editdata['category']==$rvalue['id']))?true:false);?>><?=$rvalue['name'];?></option>
                              <?php endforeach;
                                    endif;
                                    ?>
                            </select>
                          </div>
                      </div>

                      <div class="ln_solid"></div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            
                            <a href="<?=base_url();?>/admin/user" class="btn btn-primary">CANCEL</a>
                            <input type="submit" class="btn btn-success" name="submit" value="SAVE">
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
