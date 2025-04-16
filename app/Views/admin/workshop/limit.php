<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add/Modify Limit</h3>
              </div>
            </div>

            <div class="actionbtns">
  <a class="btn btn-primary" href="<?=base_url();?>/admin/workshops/limit"><i class="fa fa-arrow-left"></i> BACK</a>                 
           </div>

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                
                  <div class="x_content">
                    <br />
                    <form id="categoryForm" action="<?php echo base_url();?>/admin/workshops/set_limit" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                      <input type="hidden" name="id" value="<?=$editdata['id'];?>"  >
                      <?= csrf_field(); ?>
                      
    
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Events <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <select class="selectpicker mt-2 form-control"
                            aria-label="Default select example" name="event" id="event">
                            <option></option>
                            <?php if(is_array($events)):
                                    foreach($events as $ckey=>$cvalue):?>
                            <option value="<?=$cvalue['id'];?>" <?=set_select('event',$cvalue['id'],(isset($editdata['event']) && ($editdata['event']==$cvalue['id']))?true:false);?>><?=$cvalue['title'];?></option>
                            <?php endforeach; endif; ?> 
                        </select>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      
                      <div class="form-group col-md-6">
                      <?php if(isset($validation) && $validation->getError('event')) {?>
                          <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('event'); ?>
                          </div>
                      <?php }?>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Limit <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="limit" name="lastname" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('limit',$editdata['limit']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      
                      <div class="form-group col-md-6">
                      <?php if(isset($validation) && $validation->getError('limit')) {?>
                          <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('limit'); ?>
                          </div>
                      <?php }?>
                      </div>
                      <div class="clearfix"></div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Participation Mode </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 mt-10">
                          <div id="gender" class="btn-group mt-10" data-toggle="buttons">
                            <p>
                            <input type="radio" class="flat" name="mode" id="Onsite" value="Onsite" <?php echo set_radio('mode','Onsite',(isset($editdata['mode']) && ($editdata['mode']=='Onsite'))?'checked':'');?> /> Onsite &nbsp;&nbsp;
                            <input type="radio" class="flat" name="mode" id="Online" value="Online" <?php echo set_radio('mode','Online',(isset($editdata['mode']) && ($editdata['mode']=='Online'))?'checked':'');?> /> Online
                           </p>
                          </div>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      
                      <div class="ln_solid"></div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <!-- <input type="reset" class="btn btn-primary" name="reset" value="RESET"> -->
                            <a href="<?=base_url();?>/admin/workshops" class="btn btn-primary">CANCEL</a> 
                            <input type="submit" class="btn btn-success" name="submit" value="SAVE">
                          </div>
                        </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
