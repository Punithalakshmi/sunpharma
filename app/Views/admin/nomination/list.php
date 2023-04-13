         
         <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Manage Awards <small></small></h3>
              </div>
            </div>
           
            <div class="actionbtns">
                <a href="<?php echo base_url();?>/admin/nomination/add" class="btn btn-primary btn-xs">
                <i class="fa fa-plus"></i> Add/Modify Award</a>
           </div>
           <?= csrf_field(); ?>
            <div class="clearfix"></div>
            <?php if(session()->getFlashdata('msg')):?>
              <div class="alert alert-warning">
                  <?= session()->getFlashdata('msg') ?>
              </div>
            <?php endif;?>

            <div class="row topformsec">
            
          
            <div class="col-md-3">
            <div class="get-sunpharma__input-box mt-2 form-inline">
                    <label class="fw-bold">Award</label>
                    <input type="text" class="mt-2 form-control" name="award" id="award" />
            </div>
            </div>

            <div class="col-md-3">
            <div class="get-sunpharma__input-box mt-2 form-inline">
                    <label class="fw-bold">Award Types</label>
                    <input type="text" class="mt-2 form-control" name="type" id="type" />
            </div>
            </div>

            <div class="col-md-3">
            <div class="get-sunpharma__input-box mt-2 form-inline">
                    <label class="fw-bold">Title</label>
                    <input type="text" class="mt-2 form-control" name="title" id="title" />
            </div>
            </div>
            <div class="col-md-3">
              <div class="get-sunpharma__input-box mt-2 form-inline">
              <label for="" class="fw-bold">Subject</label>
                    
                 <input type="text" class="mt-2 form-control" name="subject" id="subject" />
                </div>
            </div>
            </div> 


            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                    </p>
                    <table id="manageAwardsDatatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Award</th>
                          <th>Award Type</th>
                          <th>Title</th>
                          <th>Subject</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Award Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                        <?php if(is_array($lists)):
                                foreach($lists as $user):
                            ?>
                        <tr>
                          <td><?=$user['main_category_id'];?></td>
                          <td><?=$user['category_id'];?></td>
                          <td><?=$user['title'];?></td>
                          <td><?=$user['subject'];?></td>
                          <td><?=$user['start_date'];?></td>
                          <td><?=$user['end_date'];?></td>
                          <td><?=($user['status'] == 1)?'Active':'InActive';?></td>
                          <td>
                            <a href="<?=base_url().'/admin/nomination/add/'.$user['id'];?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            <a onclick="userDelete('award','<?=$user['id'];?>','/admin/nomination/delete')"  class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                            <a onclick="assignedJuries('<?=$user['id'];?>')"  class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>View Mapped Juries </a>
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

    <div class="modal fade" id="juryListsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Jury Lists</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="juryListss">
        
        </div>
        <div class="modal-footer">
          
        </div>
    </div>
  </div>
</div>