<div class="loginsection">
<div class="login_wrapper">
<div class="animate form login_form">
    <section class="login_content">
    <img class="loginlogo" width="260" src="<?=base_url();?>/images/logo.jpg" alt=""> 
                  
    <form name="adminLogin" action="<?php echo base_url(); ?>/admin/login/loginAuth" method="post">
    <?=csrf_field(); ?>
        <h1>Login</h1>
        <div>
            <input type="text" class="form-control" name="username" placeholder="Username" />
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-6">
        <?php if(isset($validation) && $validation->getError('username')) {?>
        <div class='alert alert-danger mt-6'>
            <?= $error = $validation->getError('username'); ?>
            </div>
        <?php }?>
        </div>
        <div class="clearfix"></div>
        <div>
            <input type="password" class="form-control" name="password" placeholder="Password"  />
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-6">
        <?php if(isset($validation) && $validation->getError('password')) {?>
        <div class='alert alert-danger mt-6'>
            <?= $error = $validation->getError('password'); ?>
            </div>
        <?php }?>
        </div>
        <div class="clearfix"></div>
        <?php if(session()->getFlashdata('msg')):?>
                <h6 class="text-center" style="color:red;">  
                <?=session()->getFlashdata('msg') ?>
                </h6>  
        <?php endif;?>
        <div>
        
            <input type="submit" name="submit" value="LOGIN" class="btn btn-default submit" >
        </div>

        <div class="clearfix"></div>
 
    </form>
    </section>
</div>
</div></div>