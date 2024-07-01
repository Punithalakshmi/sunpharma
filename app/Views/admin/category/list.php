         
         <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Award Types <small></small></h3>
              </div>
            </div>
           
            <div class="actionbtns">
                <a href="<?php echo base_url();?>/admin/category/add" class="btn btn-primary btn-xs">
                <i class="fa fa-plus"></i> Add/Modify Fellowship Type</a>
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
                    <label for="" class="fw-bold">Select Fellowship </label>
                        <select class="selectpicker mt-2 form-control"
                            aria-label="Default select example" name="main_category_id" id="main_category_id" >
                            <option ></option>
                            <option value="1">Research Fellowships</option>
                            <option value="2">Science Scholar Fellowships</option>
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
                    <table id="awardTypeDatatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Fellowship Type</th>
                          <th>Fellowship</th>
                          <th>Status</th>
                          <th>Created Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                        <?php if(is_array($lists)):
                                foreach($lists as $user):
                            ?>
                        <tr>
                          <td><?=$user['name'];?></td>
                          <td><?=$user['type'];?></td>
                          <td><?=$user['status'];?></td>
                          <td><?=$user['created_date'];?></td>
                          <td>
                          <a href="<?=base_url().'/admin/category/add/'.$user['id'];?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            <a onclick="userDelete('award type','<?=$user['id'];?>','/admin/category/delete')"  class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
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
