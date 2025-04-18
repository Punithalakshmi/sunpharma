         
         <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Event Registration <small></small></h3>
              </div>
              
            </div>
           
            <div class="actionbtns">
                <a href="<?php echo base_url();?>/admin/eventregisteration/add" class="btn btn-primary btn-xs">
                   <i class="fa fa-plus"></i>Add/Modify Registration
                </a>

                <a href="#" onclick="exportRegistrations();" class="btn btn-primary mb-2">
                   <i class="fa fa-download"></i> Export
                </a>
           </div>

           <?= csrf_field(); ?>
                
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
                    <!-- <input type="text" class="mt-2 form-control" name="title" id="title" /> -->
                    <select class="selectpicker mt-2 form-control"
                      aria-label="Default select example" name="title" id="title">
                      <option></option>
                      <?php if(is_array($events)):
                              foreach($events as $ckey=>$cvalue):?>
                      <option value="<?=$cvalue['id'];?>" ><?=$cvalue['title'];?></option>
                      <?php endforeach; endif; ?> 
                  </select>
              </div>
              </div>

              <!-- <div class="col-md-3">
              <div class="get-sunpharma__input-box mt-2 form-inline">
                    <label class="fw-bold">Email</label>
                    <input type="text" class="mt-2 form-control" name="email" id="email" />
              </div>
              </div>

            
              <div class="col-md-3">
                <div class="get-sunpharma__input-box mt-2 form-inline">
                  <label for="" class="fw-bold">Phone</label> 
                  <input type="text" class="mt-2 form-control" name="phone" id="phone" />
                </div>
              </div> -->
            
             

              <div class="col-md-3">
                <div class="get-sunpharma__input-box mt-2 form-inline">
                    <label for="" class="fw-bold">Participation Mode </label>
                        <select class="selectpicker mt-2 form-control"
                            aria-label="Default select example" name="mode" id="mode" >
			     <option value=""></option>
                            <option value="Online">Online</option>
                            <option value="Onsite">Onsite</option>
                        </select>
                       
                    </div>
              </div>
		<div class="col-md-3">
                <div class="get-sunpharma__input-box mt-2 form-inline">
                  <label for="" class="fw-bold">Year</label> 
                  <input type="text" class="mt-2 form-control" name="year" id="year" value="<?=date("Y");?>" />
                </div>
              </div>
            </div> 

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30"></p>
                    <table id="registrationDatatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Registration Date</th>
                          <th>Registration No</th>
                          <th>Firstname</th>
                          <th>Lastname</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>Participation Mode</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(is_array($lists)):
                                foreach($lists as $user):
                            ?>
                        <tr>
                         <td><?=$user['title'];?></td>
                          <td><?=$user['created_date'];?></td>
                          <td><?=$user['registeration_no'];?></td>
                          <td><?=$user['firstname'];?></td>
                          <td><?=$user['lastname'];?></td>
                          <td><?=$user['email'];?></td>
                          <td><?=(isset($user['phone']) && ($user['phone']!='2147483647'))?$user['phone']:"-";?></td>
                          <td><?=$user['address'];?></td>
                          <td><?=$user['mode'];?></td>
                          <td style="min-width: 50px; padding: 13px 3px 8px 3px;    white-space: nowrap;">
                            <a href="<?=base_url().'/admin/eventregisteration/add/'.$user['id'];?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                            <a onclick="userDelete('registration','<?=$user['id'];?>','/admin/eventregisteration/delete')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>
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