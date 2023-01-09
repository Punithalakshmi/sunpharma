         
         <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Nominations <small></small></h3>
              </div>
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
                          <th>Nomination No</th>
                          <th>Nominee Name</th>
                          <th>Category</th>
                          <th>Email</th>
                          
                          <th>Phone</th>
                          <th>Complete By</th>
                          <th>Created Date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                        <?php if(is_array($lists)):
                                foreach($lists as $user):
                            ?>
                        <tr>
                        <td><?=$user['registration_no'];?></td>
                          <td><?=$user['firstname'].' '.$user['lastname'];?></td>
                          <td><?=$user['category_name'];?></td>
                          <td><?=$user['email'];?></td>
                          <td><?=$user['phone'];?></td>
                          <td><?=$user['end_date'];?></td>
                          <td><?=$user['created_date'];?></td>
                          <td><?=$user['review_status'];?></td>
                          <td>
                           
                            <a href="<?=base_url().'/admin/nominee/view/'.$user['id'];?>" class="btn btn-primary btn-xs">
                               <i class="fa fa-eye"></i><?=(isset($user['review_status']) && ($user['review_status'] == 'Pending'))?'Review':'View';?> 
                            </a>
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
