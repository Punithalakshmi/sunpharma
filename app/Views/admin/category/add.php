<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add/Modify Fellowship Type</h3>
              </div>
            </div>

            <div class="actionbtns">
  <a class="btn btn-primary" href="<?=base_url();?>/admin/category"><i class="fa fa-arrow-left"></i> BACK</a>
                            
           </div>

            



            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                
                  <div class="x_content formareaptag">
                    <br />
                    <form id="categoryForm" action="<?php echo base_url();?>/admin/category/add" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                      <input type="hidden" name="id" value="<?=$editdata['id'];?>"  >
                      <?= csrf_field(); ?>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 pt10" for="first-name">Fellowship Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="name" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('name',$editdata['name']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-md-6">
                      <?php if(isset($validation) && $validation->getError('name')) {?>
                          <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('name'); ?>
                          </div>
                      <?php }?>
                      </div>
                      
                      <div class="clearfix"></div>
                      

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 pt10">Status</label>
                        <div class="col-md-6 col-sm-6 col-xs-12 mt-10">
                          <div id="gender" class="btn-group mt-10" data-toggle="buttons">
                            <p>
                            <input type="radio" class="flat" name="status" id="statusActive" value="Active" <?php echo set_radio('status','Active',(isset($editdata['status']) && ($editdata['status']=='Active'))?'checked':'');?> /> Active &nbsp;&nbsp;
                            <input type="radio" class="flat" name="status" id="statusInActive" value="InActive" <?php echo set_radio('status','InActive',(isset($editdata['status']) && ($editdata['status']=='InActive'))?'checked':'');?> /> InActive
                           </p>
                          </div>
                        </div>
                      </div>

                      <div class="clearfix"></div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 pt10">Fellowship</label>
                        <div class="col-md-6 col-sm-6 col-xs-12 mt-10">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <p>
                            <input type="radio" class="flat" name="type" id="typeResearchAwards" value="Research Fellowships" <?php echo set_radio('type','Research Fellowships',(isset($editdata['type']) && ($editdata['type']=='Research Fellowships'))?'checked':'');?> /> Research Fellowships &nbsp;&nbsp;
                            <input type="radio" class="flat" name="type" id="typeScienceScholarAwards" value="Science Scholar Fellowships" <?php echo set_radio('type','Science Scholar Fellowships',(isset($editdata['type']) && ($editdata['type']=='Science Scholar Fellowships'))?'checked':'');?> /> Science Scholar Fellowships
                           </p>
                          </div>
                        </div>
                      </div>
                     
                      <div class="ln_solid"></div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <!-- <input type="reset" class="btn btn-primary" name="reset" value="RESET"> -->
                            <a href="<?=base_url();?>/admin/category" class="btn btn-primary">CANCEL</a>
                            <input type="submit" class="btn btn-success" name="submit" value="SAVE">
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
