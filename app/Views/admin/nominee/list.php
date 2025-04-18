         	   <?= csrf_field(); ?>  
         <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Nominees <small></small></h3>
		
              </div>
	     <div class="title_right">
                <h3>Submitted Nominations Total: <span class="badge badge-warning" id="submittedTotal">
                  <?=count($total_approved_nominee_lists_count)>0?count($total_approved_nominee_lists_count):0;?></span> 
<?php if(count($total_approved_nominee_lists_count) > 0){ ?><a onclick="exportNominationStatusLists('submitted');" class="btn btn-primary mb-2 downloadbtnres">
                   <i class="fa fa-download"></i>                 </a><?php } ?>
</h3> 
		<h3>Unsubmitted Nominations Total: <span class="badge badge-warning" id="unsubmittedTotal">
                   <?=count($total_rejected_nominee_lists_count)>0?count($total_rejected_nominee_lists_count):0;?></span>
<?php if(count($total_rejected_nominee_lists_count) > 0){ ?><a onclick="exportNominationStatusLists('notsubmitted');" class="btn btn-primary mb-2 downloadbtnres">
                   <i class="fa fa-download"></i></a> <?php } ?>
</h3> 
<h5><b>Approved:</b><span class="badge badge-warning" id="submittedTotal">
<?=$total_approved_lists_count;?></h5></span>
<h5><b>Rejected:</b><span class="badge badge-warning" id="submittedTotal"><?=$total_rejected_lists_count;?>
</span></h5><h5><b>Approval Pending:</b><span class="badge badge-warning" id="submittedTotal"><?=$total_pending_lists_count;?></span></h5>
           </div>
	
            </div>
          
           </div>
            <div class="clearfix"></div>
            <?php if(session()->getFlashdata('msg')):?>
              <div class="alert alert-warning">
                  <?= session()->getFlashdata('msg') ?>
              </div>
            <?php endif;?>

            <div class="row topformsec">  

            <div class="col-md-2">
                <div class="get-sunpharma__input-box mt-2 form-inline">
                    <label for="" class="fw-bold">Fellowship </label>
                        <select class="selectpicker mt-2 form-control"
                            aria-label="Default select example" name="main_category_id" id="main_category_id" onchange="getCategories(this);" >
                            <option></option>
                            <?php if(is_array($main_categories)):
                                    foreach($main_categories as $ckey=>$cvalue):?>
                            <option value="<?=$cvalue['id'];?>" ><?=$cvalue['name'];?></option>
                            <?php endforeach; endif; ?> 
                        </select>
                       
                    </div>
              </div>

              <div class="col-md-2">
            <div class="get-sunpharma__input-box mt-2 form-inline">
            
                    <label class="fw-bold">Fellowship Type</label>
                    <select class="selectpicker mt-2 form-control"
                            aria-label="Default select example" name="award_title" id="award_title"  >
                            <option></option>
                            <?php //if(is_array($awardsLists)):
                                   // foreach($awardsLists as $ckey=>$cvalue):?>
                            <option value="<?//$cvalue['title'];?>" ><?//$cvalue['title'];?></option>
                            <?php //endforeach; endif; ?> 
                        </select>
            </div>
            </div>

            <div class="col-md-2">
              <div class="get-sunpharma__input-box mt-2 form-inline">
                  <label class="fw-bold">Firstname</label>
                  <input type="text" class="mt-2 form-control" name="firstname" id="firstname" />
              </div>
            </div> 

           
              
            <div class="col-md-2">
              <div class="get-sunpharma__input-box mt-2 form-inline">
                  <label class="fw-bold">Email</label>
                  <input type="text" class="mt-2 form-control" name="email" id="email" />
              </div>
            </div>

           
            
            <div class="col-md-2">
              <div class="get-sunpharma__input-box mt-2 form-inline">
                 <label for="" class="fw-bold">Nomination Year</label>   
                 <input type="text" class="mt-2 form-control" name="year" id="year" />
                </div>
            </div>
            <?php if(isset($lists) && count($lists) > 0): ?>
            <div class="col-md-12 actionbtns">
                <a href="#" onclick="exportNominationLists();" class="btn btn-primary mb-2 downloadbtnres">
                   <i class="fa fa-download"></i> Download Nominations
                </a>
            </div>  
            <?php endif; ?>                   
            </div> 

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30"></p>
                    <table id="nomineeDatatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                            <th>Nomination No</th>
                            <th>Fellowship</th>
                            <th>Fellowship Type</th>
                            <th>Fellowship Title</th>
                            <th>Firstname</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Approval Status</th>
                          <!--  <th>Created Date</th>-->
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(count($lists) > 0 && is_array($lists)):
                                foreach($lists as $user):
                                  $status = '';
                                  if($user['status']=='Approved'){
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
                          <td><?=$user['username'];?></td>
                          <td><?=$user['email'];?></td>
                          <td><?=$user['phone'];?></td>
                          <td><?=$status;?></td>
                         <!-- <td><?//$user['created_date'];?></td>-->
                          <td>

                            <a href="<?=base_url().'/admin/nominee/view/'.$user['id'];?>" class="btn btn-primary btn-xs">
                               <i class="fa fa-eye"></i> View 
                            </a>
                            <?php if($user['is_expired_nomination'] == 'yes' && $user['is_submitted']==0): ?>
                            <a href="<?=base_url().'/admin/nominee/extend/'.$user['id'];?>" class="btn btn-primary btn-xs">
                               <i class="fa fa-edit"></i> Extend Nomination 
                            </a> 
                           
                            <?php endif; ?>   
                            <?php if( ($user['active']==0 && $user['status']=='Disapproved' && $user['is_rejected'] == 0)){ ?>
                              <button type="button" onclick="getRemarks(this,'approve','<?=$user['id'];?>');" class="btn btn-success greenbg btn-xs">Approve</button>
                              <button type="button" class="btn btn-danger btn-xs" onclick="getRemarks(this,'disapprove','<?=$user['id'];?>');">
                                <i class="fa fa-ban"></i> Reject 
                              </button>
                            <?php } ?> 
		<?php  $carryForwardFrom = strtotime(date("Y-m-d H:i:s")); 
                                   $carryForwardTo = strtotime(date("Y-08-31 23:59:59"));
                                   $lastYear = (int)date("Y") - 1;
                              if(($carryForwardTo > $carryForwardFrom) && ($user['nomination_year'] == $lastYear) && ($user['is_carry_forwarded'] == 0)): ?>
                           
                              <button type="button" onclick="carryForward(this,'forward','<?=$user['id'];?>');" class="btn btn-success greenbg btn-xs">Carry Forward To Next Year</button>
                              
                            <?php endif; ?>   
                          </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                          <tr colspan="7"> <td>No Nominees Found</td></tr>
                        <?php endif; ?>            
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

  

<!-- Modal -->
<div class="modal fade" id="remarksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remarks</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <textarea class="form-control" name="remarks" id="remarks"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-sm" id="remarksSubmit">Submit</button>
      </div>
    </div>
  </div>
</div>