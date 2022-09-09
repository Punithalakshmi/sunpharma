<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add User</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" action="<?php echo base_url();?>/admin/user/add" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                      <input type="hidden" name="id" value="<?=$editdata['id'];?>"  >
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
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
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
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
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phonenumber</label>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <p>
                              M:<input type="radio" class="flat" name="gender" id="genderM" value="M" <?php echo set_radio('gender','M',(isset($editdata['gender']) && ($editdata['gender']=='M'))?'checked':'');?> /> 
                              F:<input type="radio" class="flat" name="gender" id="genderF" value="F" <?php echo set_radio('gender','F',(isset($editdata['gender']) && ($editdata['gender']=='F'))?'checked':'');?> />
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday" name="date_of_birth" class="date-picker form-control col-md-7 col-xs-12" type="text" value="<?php echo set_value('date_of_birth',$editdata['dob']);?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Role</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="select2_single form-control" name="user_role" tabindex="-1" onchange="categoryRestrictionByRole(this);">
                            <option value=""></option>
                            <?php if(is_array($roles)):
                                    foreach($roles as $rvalue): ?>
                            <option value="<?=$rvalue['id'];?>" <?=set_select('user_role',$rvalue['id'],(isset($editdata['role']) && ($editdata['role']==$rvalue['id']))?true:false);?>><?=$rvalue['name'];?></option>
                            <?php endforeach;
                                  endif;
                                  ?>
                          </select>
                        </div>
                      </div>
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
                            <input type="reset" class="btn btn-primary" name="reset" value="RESET">
                            <input type="submit" class="btn btn-success" name="submit" value="SUBMIT">
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
