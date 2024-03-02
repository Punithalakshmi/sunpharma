<div class="loginsection">
<div class="login_wrapper">
<div class="animate form login_form">

<section class="py-5 login_content">
<img class="loginlogo" width="260" src="<?=base_url();?>/images/logo.jpg" alt=""> 

        <div class="container">
        
           
            <div class="row d-flex justify-content-center">
              
              
                        <form class="p-3 p-xl-4" name="contact" method="post" action="<?=base_url();?>/<?=$uri;?>/forgot_password">
                        <h1 style="margin-top: -25px;">Forgot Password</h1>
                        <?=csrf_field(); ?>
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
                            <div class="form-group mb-3"></div>
                            <?php if(session()->getFlashdata('msg')):?>
                                    <h6 class="text-center" style="color:red;">  
                                    <?=session()->getFlashdata('msg') ?>
                                    </h6>  
                            <?php endif;?>
                            <div class="form-group mb-3"></div>

                            <div class="clearfix"></div>
                                <div class="g-recaptcha" data-sitekey="6Ldh61ojAAAAAAamaHiBZ5mAv702yCK9qbqUQQu3"></div>
                            <div class="clearfix"></div>
                          
                            <div>
                                <button class="btn btn-primary shadow d-block w-100 mt-3" name="submit" type="submit">Send</button>
                              </div>
                        </form>
                  
</section>

</div></div></div>