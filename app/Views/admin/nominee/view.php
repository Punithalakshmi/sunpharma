<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Nominee Info</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                
                  <div class="x_content">
                    <br />
                
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?=$user['firstname'];?>
                        </div>
                      </div>
                      
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <?=$user['lastname'];?>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                     
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <?=$user['middlename'];?>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <?=$user['email'];?>
                        </div>
                       
                      </div>
                      <div class="clearfix"></div>
                     
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phonenumber</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <?=$user['phone'];?>
                        </div>
                       
                      </div>
                      <div class="clearfix"></div>
                     
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <?=(isset($user['gender']) && ($user['gender'] == 'M'))?'Male':'Female';?>
                          </div>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <?=$user['dob'];?>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      

                  </div>
                </div>
              </div>
            </div>
          <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Rating</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                
                  <div class="x_content">
                    <br />
                    <form id="categoryForm" action="<?php echo base_url();?>/admin/nominee/rating" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                      <input type="hidden" name="id" value="<?=(isset($user['id']))?$user['id']:"";?>"  >
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Rating <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="rating" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('name',((isset($editdata['rating']) && !empty($editdata['rating']))?$editdata['rating']:""));?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-md-6">
                      <?php if(isset($validation) && $validation->getError('rating')) {?>
                          <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('rating'); ?>
                          </div>
                      <?php }?>
                      </div>
                      
                      <div class="clearfix"></div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Comments</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <p>
                              <textarea></textarea>
                           </p>
                          </div>
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
