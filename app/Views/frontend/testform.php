<section class="heroInner" style="background: #fff url(<?=base_url();?>/frontend/assets/img/slide4.jpg) center left no-repeat;">
        <div class="container">
            <h1 class="fs-1 fw-bold text-capitalize fw-normal p-3 m-0 d-inline-block" style="color: var(--theme-orange);">Registration</h1>
        </div>
    </section>
<section class="py-5">
<div class="form-group md-3">
		<?php if(session()->getFlashdata('msg')):?>
		<div class="alert alert-success mt-2">
			<?= session()->getFlashdata('msg') ?>
		</div>
		<?php endif;?>
	</div>
        <div class="container">
            <div class="row">
<div class="registration-form">
           <form id="eventRegistration" method="POST" onSubmit="return testFormSubmit();"  enctype="multipart/form-data" class="form-horizontal form-label-left">
           <?= csrf_field(); ?>   
		 <div class="clearfix"></div>
                     
                     
                      <div class="clearfix"></div>   
                      <div class="form-group mb-3">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Firstname <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="first-name" name="firstname" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('firstname',$editdata['firstname']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      
                      <div class="form-group mb-3">
                      <?php if(isset($validation) && $validation->getError('firstname')) {?>
                          <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('firstname'); ?>
                          </div>
                      <?php }?>
                      </div>
                      
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
                </section>