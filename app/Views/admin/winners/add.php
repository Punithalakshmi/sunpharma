<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add/Modify Winner</h3>
              </div>
            </div>

            <div class="actionbtns">
  <a class="btn btn-primary" href="<?=base_url();?>/admin/winners"><i class="fa fa-arrow-left"></i> BACK</a>
                            
           </div>

            <?php  if(isset($validation)){
                  print_r($validation->getErrors()); } ?>
            

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                
                  <div class="x_content">
                    <br />
                    <form id="winnerForm" action="<?php echo base_url();?>/admin/winners/add" method="POST" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="<?=$editdata['id'];?>"  >
                      <?=csrf_field(); ?>
                          
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Award</label>
                        <div class="col-md-6">
                        <!--onchange="getCategories(this);" -->
                          <select class="select2_single form-control col-md-7 col-xs-12" name="main_category_id" tabindex="-1" onchange="getCategories(this);" >
                            <option value=""></option>
                            <?php if(is_array($main_categories)):
                                    foreach($main_categories as $rvalue): ?>
                            <option value="<?=$rvalue['id'];?>" <?=set_select('main_category_id',$rvalue['id'],(isset($editdata['main_category_id']) && ($editdata['main_category_id']==$rvalue['id']))?true:false);?>><?=$rvalue['name'];?></option>
                            <?php endforeach;
                                  endif;
                                  ?>
                          </select>
                        </div>
                      </div>
                      <div class="clearfix"></div>          
                      <div class="form-group col-md-6">
                      <?php if(isset($validation) && $validation->getError('main_category_id')) {?>
                        <div class='alert alert-danger mt-2'>
                          <?= $error = $validation->getError('main_category_id'); ?>
                            </div>
                        <?php }?>
                      </div>
                     
                      <div class="clearfix"></div>       

                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Award Type</label>
                        <div class="col-md-6"  id="awardTypeList">
                          <select class="select2_single form-control col-md-7 col-xs-12" name="category" tabindex="-1" >
                            <option value=""></option>
                            <?php if(is_array($categories)):
                                    foreach($categories as $rvalue): ?>
                            <option value="<?=$rvalue['id'];?>" <?=set_select('category',$rvalue['id'],(isset($editdata['category']) && ($editdata['category']==$rvalue['id']))?true:false);?>><?=$rvalue['name'];?></option>
                            <?php endforeach;
                                  endif;
                                  ?>
                          </select>
                        </div>
                      </div>
                      <div class="clearfix"></div>          
                      <div class="form-group col-md-6">
                      <?php if(isset($validation) && $validation->getError('category')) {?>
                        <div class='alert alert-danger mt-2'>
                          <?= $error = $validation->getError('category'); ?>
                            </div>
                        <?php }?>
                      </div>
                     
                      <div class="clearfix"></div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                          Winner Name
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="name" name="name" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('name',$editdata['name']);?>">
                      </div>
                      <small class="text-danger">
                      <?php if(isset($validation) && $validation->getError('name')) {?>
                          <?= $error = $validation->getError('name'); ?>
                      <?php }?>
                      </small>
                    </div>


                    <div class="clearfix"></div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                          Bio
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea class="form-control" name="bio"><?=$editdata['bio'];?></textarea>
                      </div>
                      <small class="text-danger">
                        <?php if(isset($validation) && $validation->getError('bio')) {?>
                            <?= $error = $validation->getError('bio'); ?>
                        <?php }?>
                      </small>
                    </div>
                    <div class="clearfix"></div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Year</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <p>
                              <input type="text" name="year" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('year',$editdata['year']);?>">
                           </p>
                          </div>
                        </div>
                      </div>

                    <div class="clearfix"></div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea class="form-control" name="address"><?=$editdata['address'];?></textarea>
                        
                      </div>
                      <small class="text-danger">
                      <?php if(isset($validation) && $validation->getError('address')) {?>
                          <?= $error = $validation->getError('address'); ?>
                      <?php }?>
                      </small>
                    </div>
                      
                      

                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Designation</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <p>
                            <input type="text" name="designation" id="designation" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('designation',$editdata['designation']);?>">
                           </p>
                          </div>
                        </div>
                        <small class="text-danger">
                      <?php if(isset($validation) && $validation->getError('designation')) {?>
                          <?= $error = $validation->getError('designation'); ?>
                      <?php }?>
                      </small>
                      </div>

                    
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Winner Photo</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="btn-group">
                            <p>
                                <input class="form-control" name="winner_photo" type="file" >
                           </p>
                           <?php if(isset($editdata['winner_photo']) && !empty($editdata['winner_photo'])): ?>
                              <a target="_blank" href="<?=base_url();?>/uploads/winners/<?=$editdata['winner_photo'];?>"><?=$editdata['winner_photo'];?></a>
                           <?php endif; ?>
                          </div>
                        </div>
                      </div>

                      <div class="clearfix"></div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-6 col-sm-6 col-xs-12 mt-10">
                          <div id="gender" class="btn-group mt-10" data-toggle="buttons">
                            <p>
                            <input type="radio" class="flat" name="status" id="statusActive" value="1" <?php echo set_radio('status','1',(isset($editdata['status']) && ($editdata['status']=='1'))?'checked':'');?> /> Active &nbsp;&nbsp;
                            <input type="radio" class="flat" name="status" id="statusInActive" value="0" <?php echo set_radio('status','0',(isset($editdata['status']) && ($editdata['status']=='0'))?'checked':'');?> /> InActive
                           </p>
                          </div>
                        </div>
                      </div>
                      <div class="clearfix"></div>          
                      <div class="form-group col-md-6">
                      <?php if(isset($validation) && $validation->getError('status')) {?>
                        <div class='alert alert-danger mt-2'>
                          <?= $error = $validation->getError('status'); ?>
                            </div>
                        <?php }?>
                      </div>
                      <div class="ln_solid"></div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <!-- <input type="reset" class="btn btn-primary" name="reset" value="RESET"> -->
                            <a href="<?=base_url();?>/admin/post/winners" class="btn btn-primary">CANCEL</a>
                            <input type="submit" class="btn btn-success" name="submit" value="SAVE">
                          </div>
                        </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
