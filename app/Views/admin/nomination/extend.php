<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Nomination Extend</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                
                  <div class="x_content">
                    <br />
                    <form id="categoryForm" action="<?php echo base_url();?>/admin/nominee/extend" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                      <input type="hidden" name="id" value="<?=$editdata['id'];?>"  >
                      <?= csrf_field(); ?>
                    
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Extend Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <p>
                            <input type="text" name="extend_date" id="single_cal2" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('extend_date',$editdata['extend_date']);?>">
                           </p>
                          </div>
                        </div>
                      </div>

                      
                      <div class="clearfix"></div>
                      
                
                      <div class="ln_solid"></div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <input type="reset" class="btn btn-primary" name="reset" value="RESET">
                            <input type="submit" class="btn btn-success" name="submit" value="SUBMIT">
                          </div>
                        </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
