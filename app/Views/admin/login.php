<?php if(session()->getFlashdata('msg')):?>
    <div class="alert alert-warning">
        <?= session()->getFlashdata('msg') ?>
    </div> 
<?php endif;?><div class="loginsection">
<div class="login_wrapper">
<div class="animate form login_form">
    <section class="login_content">
    <img class="loginlogo" width="260" src="<?=base_url();?>/images/logo.jpg" alt=""> 
                  
    <form name="adminLogin" action="<?php echo base_url(); ?>/admin/login/loginAuth" method="post">
    <?= csrf_field(); ?>
        <h1>Login</h1>
        <div>
        <input type="text" class="form-control" name="username" placeholder="Username" required="" />
        </div>
        <div>
        <input type="password" class="form-control" name="password" placeholder="Password" required="" />
        </div>
        <div>
        
            <input type="submit" name="submit" value="LOGIN" class="btn btn-default submit" >
        </div>

        <div class="clearfix"></div>
 
    </form>
    </section>
</div>
</div></div>