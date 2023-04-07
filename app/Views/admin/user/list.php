         
         <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Users <small></small></h3>
              </div>
            </div>
            <?= csrf_field(); ?>
            <div class="actionbtns">
                <a href="<?php echo base_url();?>/admin/user/add" class="btn btn-primary btn-xs">
                <i class="fa fa-plus"></i> Add/Modify User</a>
           </div>
            <div class="clearfix"></div>
            <?php if(session()->getFlashdata('msg')):?>
              <div class="alert alert-warning">
                  <?= session()->getFlashdata('msg') ?>
              </div>
            <?php endif;?>
            <div class="row topformsec">
            <div class="col-md-3">
            <div class="get-sunpharma__input-box mt-2 form-inline">
            <label for="" class="fw-bold">Role</label>
                    <select class="selectpicker mt-2 form-control" name="role_name" id="role_name">
                        <option></option>
                        <?php if(is_array($roles)):
                          foreach($roles as $ckey=>$cvalue):?>
                        <option value="<?=$cvalue['id'];?>"><?=$cvalue['name'];?></option>
                        <?php endforeach; endif; ?> 
                    </select>
                  
                </div>
            </div>
          
            <div class="col-md-3">
              <div class="get-sunpharma__input-box mt-2 form-inline">
                    <label class="fw-bold">Award Types</label>
                    <select class="selectpicker mt-2 form-control"
                        aria-label="Default select example" name="category" id="category">
                        <option></option>
                        <?php if(is_array($categories)):
                                foreach($categories as $ckey=>$cvalue):?>
                        <option value="<?=$cvalue['id'];?>" ><?=$cvalue['name'];?></option>
                        <?php endforeach; endif; ?> 
                    </select>
                </div>
                </div>

                <div class="col-md-3">
                  <div class="get-sunpharma__input-box mt-2 form-inline">
                          <label class="fw-bold">Firstname</label>
                          <input type="text" class="mt-2 form-control" name="firstname" id="firstname" />
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="get-sunpharma__input-box mt-2 form-inline">
                          <label class="fw-bold">Email</label>
                          <input type="text" class="mt-2 form-control" name="email" id="email" />
                  </div>
                </div>
          </div>
            
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                    </p>
                    <table id="userDatatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Firstname</th>
                          <th>Lastname</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <!-- <th>Award Types</th> -->
                          <th>Role</th>
                          <th>Created Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                        <?php if(is_array($lists)):
                                foreach($lists as $user):
                            ?>
                        <tr>
                          <td><?=$user['firstname'];?></td>
                          <td><?=$user['lastname'];?></td>
                          <td><?=strtolower($user['username']);?></td>
                          <td><?=$user['email'];?></td>
                          <td><?=$user['phone'];?></td>
                          <!-- <td><?//$user['category'];?></td> -->
                          <td><?=$user['role_name'];?></td>
                          <td><?=$user['created_date'];?></td>
                          <td>
                            <a href="<?=base_url().'/admin/user/add/'.$user['id'];?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            <a onclick="userDelete('user','<?=$user['id'];?>','/admin/user/delete')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                            <a href="<?=base_url().'/admin/user/changepassword/'.$user['id'];?>" class="btn btn-info btn-xs"><i class="fa fa-key"></i> Change Password </a>
                          </td>
                        </tr>
                        <?php endforeach;
                                endif;
                                ?>            
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          
        </footer>
        <!-- /footer content -->
      </div>
    </div>
