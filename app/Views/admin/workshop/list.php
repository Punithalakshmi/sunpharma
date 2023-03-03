         
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
                    <label class="fw-bold">Title</label>
                    <input type="text" class="mt-2 form-control" name="title" id="title" />
              </div>
              </div>

              <div class="col-md-3">
              <div class="get-sunpharma__input-box mt-2 form-inline">
                    <label class="fw-bold">Subject</label>
                    <input type="text" class="mt-2 form-control" name="subject" id="subject" />
              </div>
              </div>

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