         
         <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Nominees <small></small></h3>
              </div>
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
                          <th><input type="checkbox" name="selectall" class="selectAll"></th>
                          <th>Firstname</th>
                          <th>Lastname</th>
                          <th>Email</th>
                          <th>Phone</th>
                       
                          <th>Created Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(is_array($lists)):
                                foreach($lists as $user):
                            ?>
                        <tr>
                          <td><input type="checkbox" name="assign_jury" class="assign_jury_to_nominee" value="<?=$user['id'];?>" /></td>
                          <td><?=$user['firstname'];?></td>
                          <td><?=$user['lastname'];?></td>
                          <td><?=$user['email'];?></td>
                          <td><?=$user['phone'];?></td>
                         
                          <td><?=$user['created_date'];?></td>
                          <td>
                          <a href="<?=base_url().'/admin/nominee/getApproval/'.$user['id'];?>" class="btn btn-primary btn-xs"><i class="fa fa-check"></i>
                             Approve
                          </a>
                            <!-- <button type="button" class="btn btn-info btn-xs" onclick="nominee_approve('approve','<?//$user['id'];?>');">
                                <i class="fa fa-pencil"></i> Approve 
                            </button> -->
                            <button type="button" class="btn btn-danger btn-xs" onclick="nominee_approve('disapprove','<?=$user['id'];?>');"><i class="fa fa-ban"></i> Reject </button>
                            <a href="<?=base_url().'/admin/nominee/view/'.$user['id'];?>" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> View </a>
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
                  <?php if(is_array($juryLists)):
                           foreach($juryLists as $jvalue):
                        ?>
                        <option value="<?=$jvalue['id'];?>"><?=$jvalue['firstname'].' '.$jvalue['lastname'];?></option>
                        <?php endforeach;
                               endif; ?>
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
