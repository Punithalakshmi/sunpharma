<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add/Modify Event</h3>
              </div>
              <div class="title_right">
              <div class="actionbtns">
                <a class="btn btn-primary" href="<?=base_url();?>/admin/workshops">
                  <i class="fa fa-arrow-left"></i> BACK
                </a>                 
              </div>

              </div>
            </div>
          
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                
                  <div class="x_content">
                    <br />
                    <form id="eventForm" action="<?php echo base_url();?>/admin/workshops/add" method="POST" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="<?=$editdata['id'];?>"  >
                      <?= csrf_field(); ?>
                      <div class="clearfix"></div>
                      <div id="categorySelection" class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Event Type</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="select2_single form-control" name="category" tabindex="-1">
                              <option value=""></option>
                                <?php if(is_array($eventTypes)):
                                     foreach($eventTypes as $key=>$type): ?>
                                     <option value="<?=$type['id'];?>" <?=set_select('category',$type['id'], ((isset($editdata['category']) && ($editdata['category']==$type['id']))?TRUE:FALSE));?>><?=$type['event_type'];?></option>
                                <?php endforeach; 
                                  endif; ?>
                            </select>
                          </div>
                      </div>

                      <div class="clearfix"></div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                            Title
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="title" name="title" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('title',$editdata['title']);?>">
                        </div>
                        <small class="text-danger">
                        <?php if(isset($validation) && $validation->getError('title')) {?>
                            <?= $error = $validation->getError('title'); ?>
                        <?php }?>
                        </small>
                      </div>

                     
                      <div class="clearfix"></div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                            Subject
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="subject" name="subject" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('subject',$editdata['subject']);?>">
                        </div>
                        <small class="text-danger">
                        <?php if(isset($validation) && $validation->getError('subject')) {?>
                            <?= $error = $validation->getError('subject'); ?>
                        <?php }?>
                        </small>
                      </div>
                     

                      <div class="clearfix"></div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Description</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea class="form-control" name="description"><?=$editdata['description'];?></textarea>
                          
                        </div>
                        <small class="text-danger">
                        <?php if(isset($validation) && $validation->getError('description')) {?>
                            <?= $error = $validation->getError('description'); ?>
                        <?php }?>
                        </small>
                      </div>
                      
                      <div class="clearfix"></div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Start Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <p>
                            <input type="text" id="single_cal3" name="start_date" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('start_date',$editdata['start_date']);?>">
                           </p>
                          </div>
                        </div>
                      </div>

                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">End Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <p>
                            <input type="text" name="end_date" id="single_cal2" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('end_date',$editdata['end_date']);?>">
                           </p>
                          </div>
                        </div>
                      </div>
                     
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Invitation Document</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="btn-group flex-column">
                            
                                <input class="form-control" name="event_document" type="file" >
                          
                           <?php if(isset($editdata['event_document']) && !empty($editdata['event_document'])): ?>
                              <a target="_blank" href="<?=base_url();?>/uploads/events/<?=$editdata['event_document'];?>"><?=$editdata['event_document'];?></a>
                           <?php endif; ?>
                          </div>
                        </div>
                      </div>

                      <div class="clearfix"></div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Agenda</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="btn-group flex-column">
                            <p><input class="form-control" name="agenda" type="file"></p>
                           <?php if(isset($editdata['agenda']) && !empty($editdata['agenda'])): ?>
                              <a target="_blank" href="<?=base_url();?>/uploads/events/<?=$editdata['agenda'];?>"><?=$editdata['agenda'];?></a>
                           <?php endif; ?>
                          </div>
                        </div>
                      </div>

                      <div class="clearfix"></div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Banner Image</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="btn-group flex-column">
                            <p>
                                <input class="form-control" name="banner_image" type="file" >
                           </p>
                           <?php if(isset($editdata['banner_image']) && !empty($editdata['banner_image'])): ?>
                              <a target="_blank" href="<?=base_url();?>/uploads/events/<?=$editdata['banner_image'];?>"><?=$editdata['banner_image'];?></a>
                           <?php endif; ?>
                          </div>
                        </div>
                      </div>

                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Thumb Image</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="btn-group flex-column">
                            <p>
                                <input class="form-control" name="thumb_image" type="file" >
                           </p>
                           <?php if(isset($editdata['thumb_image']) && !empty($editdata['thumb_image'])): ?>
                              <a target="_blank" href="<?=base_url();?>/uploads/events/<?=$editdata['thumb_image'];?>"><?=$editdata['thumb_image'];?></a>
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
