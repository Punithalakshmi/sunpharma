         
         <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Events <small></small></h3>
              </div>
            </div>
            <?= csrf_field(); ?>
            <div class="actionbtns">
              <a href="<?php echo base_url();?>/admin/workshops/add" class="btn btn-primary btn-xs">
                  <i class="fa fa-plus"></i>Add/Modify Event
              </a>
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
                    <label for="" class="fw-bold">Title </label>
                        <select class="selectpicker mt-2 form-control"
                            aria-label="Default select example" name="title" id="title"  >
                            <option></option>
                            <?php if(is_array($evts)):
                                    foreach($evts as $ckey=>$cvalue):?>
                            <option value="<?=$cvalue['title'];?>" ><?=$cvalue['title'];?></option>
                            <?php endforeach; endif; ?> 
                        </select>
                    </div>
                    </div>

           
                   
              <div class="col-md-3">
                <div class="get-sunpharma__input-box mt-2 form-inline">
                    <label for="" class="fw-bold">Subject</label>
                    <select class="selectpicker mt-2 form-control"
                            aria-label="Default select example" name="subject" id="subject"  >
                            <option></option>
                            <?php if(is_array($evts)):
                                    foreach($evts as $ckey=>$cvalue):?>
                            <option value="<?=$cvalue['subject'];?>" ><?=$cvalue['subject'];?></option>
                            <?php endforeach; endif; ?> 
                        </select>
                  </div>
                  </div>
<!--             
              <div class="col-md-3">
              <div class="get-sunpharma__input-box mt-2 form-inline">
              evts
                    <label class="fw-bold">Title</label>
                    <input type="text" class="mt-2 form-control" name="title" id="title" />
              </div>
              </div>

              <div class="col-md-3">
              <div class="get-sunpharma__input-box mt-2 form-inline">
                    <label class="fw-bold">Subject</label>
                    <input type="text" class="mt-2 form-control" name="subject" id="subject" />
              </div>
              </div> -->

              <!-- <div class="col-md-3">
              <div class="get-sunpharma__input-box mt-2 form-inline">
                      <label class="fw-bold">Start Date</label>
                      <input type="text" class="mt-2 form-control" name="start_date" id="start_date" />
              </div>
              </div> -->
              <div class="col-md-3">
                <div class="get-sunpharma__input-box mt-2 form-inline">
                  <label for="" class="fw-bold">Status</label> 
                  <input type="text" class="mt-2 form-control" name="status" id="status" />
                </div>
              </div>
              
              </div> 

           </div>
            
           
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30"></p>
                    <table id="eventDatatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Subject</th>
                          <th>Description</th>
                          <th class="datecol">Start Date</th>
                          <th class="datecol">End Date</th>
                          <th class="datecol">Created Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(is_array($lists)):
                                foreach($lists as $user):
                            ?>
                        <tr>
                        <td><?=$user['title'];?></td>
                          <td><?=$user['subject'];?></td>
                          <td><?=$user['description'];?></td>
                          <td><?=$user['start_date'];?></td>
                          <td><?=$user['end_date'];?></td>
                          <td><?=$user['created_date'];?></td>
                          <td>
                            
                            <a href="<?=base_url().'/admin/workshops/add/'.$user['id'];?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                            <a onclick="userDelete('Event','<?=$user['id'];?>','/admin/workshops/delete/')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>
                            <a onclick="setUserLimit('<?=$user['title'];?>','<?=$user['id'];?>','/admin/workshops/set_limit/')" class="btn btn-danger btn-xs"><i class="fa fa-ban"></i> Set Limit</a>
                            
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
<div class="modal fade" id="setLimitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Set Limit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <input class="form-control" type="number" name="limit" id="limit"  />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CANCEL</button>
        <button type="button" class="btn btn-primary btn-sm" id="setLimitSubmit">SAVE</button>
      </div>
    </div>
  </div>
</div>