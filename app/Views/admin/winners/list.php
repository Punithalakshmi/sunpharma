         
         <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Winners <small></small></h3>
              </div>
            </div>
           
            <div class="actionbtns">
              <a href="<?php echo base_url();?>/admin/winners/add" class="btn btn-primary btn-xs">
                  <i class="fa fa-plus"></i>Add/Modify Winners
              </a>
           </div>
           
           </div>
            <div class="clearfix"></div>
            <?php if(session()->getFlashdata('msg')):?>
              <div class="alert alert-warning">
                  <?= session()->getFlashdata('msg') ?>
              </div>
            <?php endif;?>
            <?= csrf_field(); ?>

            <div class="row topformsec">
            
                <div class="col-md-3">
                    <div class="get-sunpharma__input-box mt-2 form-inline">
                    <label for="" class="fw-bold">Fellowship </label>
                        <select class="selectpicker mt-2 form-control"
                            aria-label="Default select example" name="award" id="award"  >
                            <option></option>
                            <?php if(is_array($main_categories)):
                                    foreach($main_categories as $ckey=>$cvalue):?>
                            <option value="<?=$cvalue['name'];?>" ><?=$cvalue['name'];?></option>
                            <?php endforeach; endif; ?> 
                        </select>
                    </div>
                    </div>

           
                   
              <div class="col-md-3">
                <div class="get-sunpharma__input-box mt-2 form-inline">
                    <label for="" class="fw-bold">Fellowship Types</label>
                    <select class="selectpicker mt-2 form-control"
                            aria-label="Default select example" name="type" id="type"  >
                            <option></option>
                            <?php if(is_array($awardTypes)):
                                    foreach($awardTypes as $ckey=>$cvalue):?>
                            <option value="<?=$cvalue['name'];?>" ><?=$cvalue['name'];?></option>
                            <?php endforeach; endif; ?> 
                        </select>
                  </div>
                  </div>
          

            <div class="col-md-3">
            <div class="get-sunpharma__input-box mt-2 form-inline">
                    <label class="fw-bold">Year</label>
                    <input type="text" class="mt-2 form-control" name="year" id="year" />
            </div>
            </div>
            
            </div> 
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30"></p>
                    <table id="postWinnersDatatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Fellowships</th>
                          <th>Fellowship Type</th>
                          <th>Photo</th>
                          <th>Designation</th>
                          <th>Year</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(is_array($lists)):
                                foreach($lists as $user):
                            ?>
                        <tr>
                        <td><?=$user['name'];?></td>
                          <td><?=$user['main_category'];?></td>
                          <td><?=$user['category'];?></td>
                          <td><?=$user['photo'];?></td>
                          <td><?=$user['designation'];?></td>
                          <td><?=$user['year'];?></td>
                          <td><?=(isset($user['status']) && ($user['status']==1))?'Active':'InActive';?></td>
                          <td>
                          <a href="<?=base_url().'/admin/winners/add/'.$user['id'];?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                            <a onclick="userDelete('Winner','<?=$user['id'];?>','/admin/winners/delete/')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>
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