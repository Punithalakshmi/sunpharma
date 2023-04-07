<section class="py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h3 class="heading" style="color: #F7941E;">Reset Password</h3>
                </div>
            </div>
            <?php if(session()->getFlashdata('success')):?>
                <h6 class="text-center" style="color:green;">  
                     <?=session()->getFlashdata('msg') ?>
                </h6>  
           <?php endif;?>
            <div class="row d-flex justify-content-center">
              
                <div class="col-md-6 col-xl-4">
                    <div>
                        <form class="p-3 p-xl-4" name="reset_password" method="post" action="<?=base_url();?>/admin/update_password">
                        <?=csrf_field(); ?>
                            <div class="clearfix"></div>
                            <div class="mb-3">
                                <input class="form-control" type="password"  name="password" placeholder="New Password" value="<?php echo set_value('password',$editdata['password']);?>"></div>
                                <div class="clearfix"></div>
                            <div class="form-group md-3">
                            <?php if(isset($validation) && $validation->getError('password')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('password'); ?>
                                    </div>
                                <?php }?>
                            </div>

                            <div class="clearfix"></div>
                            <div class="mb-3">
                                <input class="form-control" type="password"  name="confirm_password" placeholder="Confirm New Password" value="<?php echo set_value('confirm_password',$editdata['confirm_password']);?>"></div>
                                <div class="clearfix"></div>
                            <div class="form-group md-3">
                            <?php if(isset($validation) && $validation->getError('confirm_password')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('confirm_password'); ?>
                                    </div>
                                <?php }?>
                            </div>

                            <div class="form-group mb-3"></div>
                            <?php if(session()->getFlashdata('msg') || session()->getFlashdata('error')):?>
                                    <h6 class="text-center" style="color:red;">  
                                    <?=session()->getFlashdata('msg') ?>
                                    </h6>  
                            <?php endif;?>
                            <div class="clearfix"></div>
                            
                          
                            <div>
                                <button class="btn btn-primary shadow d-block w-100" name="submit" type="submit">Reset Password</button>
                              </div>
                        </form>
                    </div>
                </div>
</section>