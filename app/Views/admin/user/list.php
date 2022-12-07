         
         <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Users <small></small></h3>
              </div>
            </div>
           
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
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                    </p>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Firstname</th>
                          
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Category</th>
                          <th>Created Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                        <?php if(is_array($lists)):
                                foreach($lists as $user):
                            ?>
                        <tr>
                          <td><?=$user['firstname'].' '.$user['lastname'];?></td>
                        
                          <td><?=$user['email'];?></td>
                          <td><?=$user['phone'];?></td>
                          <td><?=$user['category'];?></td>
                          <td><?=$user['created_date'];?></td>
                          <td>
                          <a href="<?=base_url().'/admin/user/add/'.$user['id'];?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a><a href="<?=base_url().'/admin/user/delete/'.$user['id'];?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a><a href="<?=base_url().'/admin/user/changepassword/'.$user['id'];?>" class="btn btn-info btn-xs"><i class="fa fa-key"></i> Change Password </a>
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
