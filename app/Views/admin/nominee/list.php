         
         <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Nominees <small></small></h3>
              </div>
            </div>
           
       
            <?= csrf_field(); ?>   
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
                           <th>Award</th>
                           <th>Award Type</th>
                           <th>Award Title</th>
                          <th>Firstname</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Approval Status</th>
                          <th>Created Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(count($lists) > 0 && is_array($lists)):
                                foreach($lists as $user):
                                  $status = '';

                                  if($user['active']==1 && $user['status']=='Approved'){
                                    $status = "Approved";
                                  }
                                  else if($user['is_rejected'] == 1){
                                    $status = "Rejected";
                                  }
                                  else
                                  {
                                    $status = "Pending";
                                  }

                            ?>
                        <tr>
                          <td><?=$user['registration_no'];?></td>
                          <td><?=$user['main_category_name'];?></td>
                          <td><?=$user['category_name'];?></td>
                          <td><?=$user['title'];?></td>
                          <td><?=$user['firstname'];?></td>
                          <td><?=strtolower($user['firstname']);?></td>
                          <td><?=$user['email'];?></td>
                          <td><?=$user['phone'];?></td>
                          <td><?=$status;?></td>
                          <td><?=$user['created_date'];?></td>
                          <td>
                            <a href="<?=base_url().'/admin/nominee/view/'.$user['id'];?>" class="btn btn-primary btn-xs">
                               <i class="fa fa-eye"></i> View 
                            </a>
                            <?php if($user['is_expired_nomination'] == 'yes'): ?>
                            <a href="<?=base_url().'/admin/nominee/extend/'.$user['id'];?>" class="btn btn-primary btn-xs">
                               <i class="fa fa-edit"></i> Extend Nomination 
                            </a> 
                           
                            <?php endif; ?>   
                            <?php if( ($user['active']==0 && $user['status']=='Disapproved' && $user['is_rejected'] == 0)){ ?>
                            <button type="button" onclick="nominee_approve('approve','<?=$user['id'];?>');" class="btn btn-success greenbg btn-xs">Approve</button>
                              <button type="button" class="btn btn-danger btn-xs" onclick="nominee_approve('disapprove','<?=$user['id'];?>');">
                                <i class="fa fa-ban"></i> Reject 
                            </button>
                            <?php } ?>  
                          </td>
                        </tr>
                        <?php endforeach; ?>

                        <?php else: ?>
                          <tr colspan="7"> <td>No Nominees Found</td></tr>
                             <?php
                                endif;
                                ?>            
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              
<!-- Modal -->
<div class="modal fade" id="juryListsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Jury Lists</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form name="juryListsForm" id="juryListsForm" >
                 <option value=" "></option>
                <select name="juryLists" id="juryLists" class="form-control">
                  <?php //if($juryLists && count($juryLists) > 0 && is_array($juryLists)):
                           //foreach($juryLists as $jvalue):
                        ?>
                        <option value="<?//$jvalue['id'];?>"><?//$jvalue['firstname'].' '.$jvalue['lastname'];?></option>
                        <?php //endforeach;
                              // endif; ?>
                </select>                
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
        <button type="button" class="btn btn-primary" onclick="assignJuryToNominee();";>ASSIGN</button>
      </div>
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
