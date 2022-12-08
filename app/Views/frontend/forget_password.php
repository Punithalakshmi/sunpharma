<section class="py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h3 class="heading" style="color: #F7941E;">Forget Password</h3>
                </div>
            </div>
            <?php //if(isset($validation) && $validation->getErrors()) { print_r($validation->getErrors()); die; }?>
            <div class="row d-flex justify-content-center">
                <div class="form-group md-3">
                    <?php if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-success mt-2">
                        <?= session()->getFlashdata('msg') ?>
                    </div>
                    <?php endif;?>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div>
                        <form class="p-3 p-xl-4" name="contact" method="post" action="<?=base_url();?>/forget_password">
                            
                            <div class="clearfix"></div>
                            <div class="mb-3">
                                <input class="form-control" type="email" id="email-1" name="email" placeholder="Email" value="<?php echo set_value('email',$editdata['email']);?>"></div>
                                <div class="clearfix"></div>
                            <div class="form-group md-3">
                            <?php if(isset($validation) && $validation->getError('email')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('email'); ?>
                                    </div>
                                <?php }?>
                            </div>
                          
                            <div class="clearfix"></div>
                          
                            <div>
                                <button class="btn btn-primary shadow d-block w-100" type="submit">Send</button>
                              </div>
                        </form>
                    </div>
                </div>
</section>