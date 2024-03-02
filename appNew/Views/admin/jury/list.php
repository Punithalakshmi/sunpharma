              
         <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Mapped Juries <small></small></h3>
              </div>
            </div>
           
       
            <?= csrf_field(); ?>
            <div class="actionbtns">
                <a href="<?php echo base_url();?>/admin/jury/mapping" class="btn btn-primary btn-xs">
                <i class="fa fa-plus"></i> Map Jury</a>
           </div>
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
                    <label class="fw-bold">Award</label>
                    <!-- <input type="text" class="mt-2 form-control" name="title" id="title" /> -->
                    <select class="selectpicker mt-2 form-control"
                      aria-label="Default select example" name="award" id="award">
                      <option></option>
                      <?php if(is_array($awards)):
                              foreach($awards as $ckey=>$cvalue):?>
                      <option value="<?=$cvalue['id'];?>" ><?=$cvalue['title'];?></option>
                      <?php endforeach; endif; ?> 
                  </select>
              </div>
              </div>

              <div class="col-md-3">
              <div class="get-sunpharma__input-box mt-2 form-inline">
                    <label class="fw-bold">Jury</label>
                    <!-- <input type="text" class="mt-2 form-control" name="title" id="title" /> -->
                    <select class="selectpicker mt-2 form-control"
                      aria-label="Default select example" name="jury" id="jury">
                      <option></option>
                      <?php if(is_array($juries)):
                              foreach($juries as $ckey=>$cvalue): if($cvalue['role'] == 1):?>
                      <option value="<?=$cvalue['id'];?>" ><?=$cvalue['firstname'];?></option>
                      <?php endif; endforeach; endif; ?> 
                  </select>
              </div>
              </div>

           
            </div> 

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                    </p>
                    <table id="juryMappingDatatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                         
                          
                           <th>Mapped Juries</th>
                           <th>Award</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(count($lists) > 0 && is_array($lists)):
                                foreach($lists as $user):
                                 
                            ?>
                        <tr>
                          <td><?=$user['title'];?></td>
                          <td><?=$user['jury'];?></td>
                      
                          
                        </tr>
                        <?php endforeach; ?>

                        <?php else: ?>
                          <tr colspan="2"> <td>No Records Found</td></tr>
                             <?php
                                endif;
                                ?>            
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
