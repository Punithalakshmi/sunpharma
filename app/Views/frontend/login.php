<div class="registration-form">
    <form method="post" name="login" action="<?=base_url();?>/login">
      <?=csrf_field(); ?>
        <h3 class="text-center">Login</h3>
        <div class="form-group mb-3">
            <input class="form-control item" type="text" id="username" placeholder="Username" name="username" required="" minlength="4"  pattern="^[a-zA-Z0-9_.-]*$">
        </div>
        <div class="form-group mb-3">
            <input class="form-control item" type="password" id="password" placeholder="Password" name="password" required="" minlength="6"></div>
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
        <div class="form-group mb-3">
            <button class="btn btn-primary btn-sm d-block create-account w-100" name="submit" type="submit">Login</button></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="text-align: center;">
                           <a  href="<?=base_url();?>/forgot_password"><u>Forgot Password</u></a>
                          <a onclick="history.back()" href="#"><u>Back</u></a>
                 </div>
            </div>
        </div>
    </form>
</div>
