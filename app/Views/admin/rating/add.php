<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Update Rating</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                
                  <div class="x_content">
                    <br />
                    <?php $uri4 = $current_url->getSegment(4); $uri5 = $current_url->getSegment(5); ?>
                    <form id="ratingForm" action="<?php echo base_url();?>/admin/rating/add/<?=$uri4;?>/<?=$uri5;?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                      <input type="hidden" name="id" value="<?=$editdata['id'];?>"  >
                      <?=csrf_field();?>
                      <input type="hidden" name="nominee_id" value="<?=$editdata['nominee_id'];?>"  >
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Rating <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="rating" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('rating',$editdata['rating']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-md-6">
                      <?php if(isset($validation) && $validation->getError('rating')) {?>
                          <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('rating'); ?>
                          </div>
                      <?php }?>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Comments <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="comments"><?=$editdata['comments'];?></textarea>
                        </div>
                      </div>

                     
                      <div class="ln_solid"></div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <!-- <input type="reset" class="btn btn-primary" name="reset" value="RESET"> -->
                            
                            <a href="<?=base_url();?>/admin/nominee/view/<?=$uri;?>" class="btn btn-primary">CANCEL</a> 
                            <input type="submit" class="btn btn-success" name="submit" value="SAVE">
                          </div>
                        </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
