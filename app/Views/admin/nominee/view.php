<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>View User</h3>
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
