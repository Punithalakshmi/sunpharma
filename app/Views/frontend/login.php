 <!--Page Header Start-->
 <section class="page-header">
            <div class="page-header-bg" style="background-image: url(<?=base_url();?>/frontend/assets/images/backgrounds/page-header-bg-login.jpg)">
            </div>
            <div class="page-header-shape-1"><img src="<?=base_url();?>/frontend/assets/images/shapes/page-header-shape-1.png" alt=""></div>
            <div class="container">
                <div class="page-header__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="/">Home</a></li>
                        <li><span>/</span></li>
                        <li>Member Login</li>
                    </ul>
                    <h2>Member Login</h2>
                </div>
            </div>
        </section>
        <!--Page Header End-->

         <!--Message One Start-->
         <section class="message-one">
            <div class="message-one-shape-1" style="background-image: url(<?=base_url();?>/frontend/assets/images/shapes/message-one-shape-1.png);"></div>
            <div class="message-one-shape-2" style="background-image: url(<?=base_url();?>/frontend/assets/images/shapes/message-one-shape-2.png);"></div>
            <div class="container">
                <div class="section-title text-center">
                    <div class="section-sub-title-box">
                        <p class="section-sub-title">Please give your login credentials below:</p>
                        <div class="section-title-shape-1">
                            <img src="<?=base_url();?>/frontend/assets/images/shapes/section-title-shape-1.png" alt="">
                        </div>
                        <div class="section-title-shape-2">
                            <img src="<?=base_url();?>/frontend/assets/images/shapes/section-title-shape-2.png" alt="">
                        </div>
                    </div>
                    <h2 class="section-title__title">Member Login</h2>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="message-one__form loginsec">
                            <form name="login" action="<?=base_url();?>/login" method="POST" class="comment-one__form" >
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="get-insuracne-two__input-box">
                                            <label><strong>Email</strong></label>
                                            <input type="text" placeholder="Email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="get-insuracne-two__input-box">
                                            <label><strong>Password</strong></label>
                                            <input type="password" placeholder="Password" name="password">
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="get-insuracne-two__input-box">
                                            <p>
                                                <!-- <a href="/reset_password">Reset Password</a> | -->
                                                 <a href="/forget_password">Forgot Password</a></p>
                                        </div>
                                    </div>
                                  
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        
                                        <div class="comment-form__btn-box">
                                            <button type="submit" class="thm-btn comment-form__btn">Login</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Message One End-->
