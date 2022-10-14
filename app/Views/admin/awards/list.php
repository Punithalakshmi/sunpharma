         
         <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Award Lists <small></small></h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row topformsec">
            <div class="col-md-3">
            <div class="get-sunpharma__input-box mt-2 form-inline">
            <label for="" class="fw-bold">Category</label>
                    <select class="selectpicker mt-2 form-control"
                        aria-label="Default select example" name="category" id="category">
                        <option></option>
                        <?php if(is_array($categories)):
                                foreach($categories as $ckey=>$cvalue):?>
                        <option value="<?=$cvalue['id'];?>" <?=set_select('category',$cvalue['id'], ((isset($editdata['category']) && ($editdata['category']==$cvalue['id']))?TRUE:FALSE));?>><?=$cvalue['name'];?></option>
                        <?php endforeach; endif; ?> 
                    </select>
                    <small class="text-danger">
                    <?php if(isset($validation) && $validation->getError('category')) {?>
                        <?= $error = $validation->getError('category'); ?>
                    <?php }?>
                    </small>  
                </div>
            </div>
          
            <div class="col-md-3">
            <div class="get-sunpharma__input-box mt-2 form-inline">
                    <label for="" class="fw-bold">Year</label>
                    <select class="selectpicker mt-2 form-control"
                        aria-label="Default select example" name="year" id="year">
                        <option></option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option> 
                    </select>
            </div>
            </div>
            <div class="col-md-3">
                    <button class="btn btn-primary mb-2" name="search" id="search" onclick="getAwardLists()">Search</button>
            </div>
            <div class="col-md-3 actionbtns">
                <a href="#" onclick="exportResult();" class="btn btn-primary mb-2">
                   <i class="fa fa-download"></i> Download Result
                </a>
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
                          <th></th>
                          <th>Award Category</th>
                          <th>Nominee Name</th>
                          <th>Nomination No</th>
                          <th>DOB</th>
                          <th>Rating</th>
                        </tr>
                      </thead>
                      <tbody id="getLists">
                           
                          <?php 
                            if(is_array($lists)):
                                    foreach($lists as $user):
                            ?>
                                <tr>
                                    <td class="iconcal"><i class="expandChildTable fa fa-plus-circle"></i></td>
                                    <td><?=$user['category_name'];?></td>
                                    <td><?=$user['firstname'];?></td>
                                    <td><?=date("Y")."/".$user['id'];?></td>
                                    <td><?=$user['dob'];?></td>
                                    <td><?=round($user['average_rating']);?></td>
                                </tr>
                                <?php if(is_array($user['juries']) && count($user['juries']) > 0): ?>
                                  <tr class="childTableRow ">
                                      <td colspan="6">
                                          <h5>Jury Info</h5>
                                          <table class="table graybg">
                                              <thead>
                                              <tr>
                                                  <th>Jury</th>
                                                  <th>Rating</th>
                                              </tr>
                                              </thead>
                                              <tbody>
                                                <?php foreach($user['juries'] as $ukey => $uvalue): ?>
                                                  <tr>
                                                      <td><?=$uvalue['firstname'].' '.$uvalue['lastname'];?></td>
                                                      <td><?=$uvalue['rating'];?></td>
                                                  </tr>
                                                <?php endforeach;?>  
                                              </tbody>
                                          </table>
                                      </td>            
                                  </tr>
                            <?php    endif;
                                     endforeach;
                                     endif;
                            ?>
                          
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        <!-- /page content -->
      </div>
    </div>
