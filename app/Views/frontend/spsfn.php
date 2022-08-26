<!--Page Header Start-->
        <section class="page-header">
            <div class="page-header-bg" style="background-image: url(<?=base_url();?>/frontend/assets/<?=base_url();?>/frontend/assets/images/backgrounds/page-header-bg.jpg)">
            </div>
            <div class="page-header-shape-1"><img src="<?=base_url();?>/frontend/assets/<?=base_url();?>/frontend/assets/images/shapes/page-header-shape-1.png" alt=""></div>
            <div class="container">
                <div class="page-header__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="/">Home</a></li>
                        <li><span>/</span></li>
                        <li>SPSFN</li>
                    </ul>
                    <h2>SPSFN</h2>
                </div>
            </div>
        </section>
        <!--Page Header End-->

        <!--Form Page Start-->
        <section class="contact-page">
            <div class="container">

                <div class="row">
                    <div class="col-12">
                        <h3 class="section-title__title mb-5">Nomination - Sun Pharma Science Foundation Research Awards 2022
                        </h3>
                    </div>
                </div>
                <div class="row">
                
                </div>   
                <form name="research_awards" id="research_awards" method="POST" action="<?=base_url();?>/spsfn" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xl-3 col-lg-4">
                        <div class="contact-page__left">
                            <div class="m-card">
                                <div class="m-card-body text-center">
                                    <img src="<?=base_url();?>/frontend/assets/images/user--default-Image.png" class="img-fluid" alt="">
                                </div>
                                <div class="m-card-footer">
                                    <!-- <label for="formFile3" class="form-label">Attach </label> -->
                                    <input class="form-control my-3" name="nominator_photo" type="file" id="formFile3">
                                    
                                    <small class="text-danger">
                                    <?php if(isset($validation) && $validation->getError('nominator_photo')) {?>
                                      
                                        <?= $error = $validation->getError('nominator_photo'); ?>
                                     
                                    <?php }?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8">
                        <div class="contact-page__right">
                            <div class="contact-page__form">
                                <!-- <form action="<?=base_url();?>/frontend/assets/inc/sendemail.php" class="comment-one__form contact-form-validated" novalidate="novalidate"> -->
                                    <div class="row">
                                    <?php if(session()->getFlashdata('msg')):?>
                                        <div class="col-xl-3 col-lg-4">
                                            <?= session()->getFlashdata('msg') ?>
                                        </div>
                                    <?php endif;?>
                                        <div class="col-xl-6">                                           
                                            <label for="" class="fw-bold">Category of the Award</label>
                                            <div class="get-sunpharma__input-box mt-2">
                                                
                                                <select class="selectpicker mt-2"
                                                    aria-label="Default select example" name="category">
                                                    <option selected>-- Select --</option>
                                                    <option value="Medical Sciences-Basic Research">Medical Sciences-Basic Research</option>
                                                    <option value="Medical Sciences-Clinical Research">Medical Sciences-Clinical Research</option>
                                                    <option value="Pharmaceutical Sciences">Pharmaceutical Sciences</option>
                                                </select>
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('category')) {?>
                                      
                                                            <?= $error = $validation->getError('category'); ?>
                                                    
                                                    <?php }?>
                                                </small>
                                            </div>
                                            
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="get-sunpharma__input-box">
                                                <label for="" class="fw-bold">Name of the Applicant</label>
                                                <input type="text" class="" placeholder="" name="nominee_name">
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('nominee_name')) {?>
                                      
                                                        <?= $error = $validation->getError('nominee_name'); ?>
                                                
                                                <?php }?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">                                           
                                            <label for="" class="fw-bold">Date of Birth</label>
                                            <div class="get-sunpharma__input-box mt-2">
                                                <input type="date" placeholder="" name="date_of_birth" >
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('date_of_birth')) {?>
                                      
                                                    <?= $error = $validation->getError('date_of_birth'); ?>
                                            
                                                <?php }?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="get-sunpharma__input-box">
                                                <label for="" class="fw-bold">Citizenship</label>
                                                <select class="selectpicker mt-2"
                                                    aria-label="Default select example" name="citizenship">
                                                    <option selected>-- Select --</option>
                                                    <option value="1">Indian</option>
                                                    <option value="2">Other</option>
                                                </select>
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('citizenship')) {?>
                                      
                                                        <?= $error = $validation->getError('citizenship'); ?>
                                                
                                                    <?php }?>
                                                </small>
                                            </div>
                                        </div>


                                        <div class="col-xl-6">
                                            <label for="" class="fw-bold">Designation & Office Address</label>
                                            <div class="get-sunpharma__comment-box comment-form__input-box text-message-box mt-2">
                                                <textarea name="designation_and_office_address" placeholder="Write a message"></textarea>
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('designation_and_office_address')) {?>
                                      
                                                    <?= $error = $validation->getError('designation_and_office_address'); ?>
                                            
                                                <?php }?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">                                           
                                            <label for="" class="fw-bold">Residence Address</label>
                                            <div class="get-sunpharma__comment-box comment-form__input-box text-message-box mt-2">
                                                <textarea name="residence_address" placeholder="Write a message"></textarea>
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('residence_address')) {?>
                                      
                                                    <?= $error = $validation->getError('residence_address'); ?>
                                            
                                                <?php }?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">                                           
                                            <label for="" class="fw-bold">Email ID</label>
                                            <div class="get-sunpharma__input-box mt-2">
                                                <input type="email" placeholder="" name="email">
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('email')) {?>
                                                    <?= $error = $validation->getError('email'); ?>
                                                <?php }?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">                                           
                                            <label for="" class="fw-bold">Mobile No</label>
                                            <div class="get-sunpharma__input-box mt-2">
                                                <input type="number" placeholder="" name="mobile_no">
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('mobile_no')) {?>
                                                    <?= $error = $validation->getError('mobile_no'); ?>
                                                <?php }?>
                                                </small>
                                            </div>
                                        </div>

                                        

                                        <div class="col-xl-4">                                           
                                            <label for="" class="fw-bold">Name of the Nominator</label>
                                            <div class="get-sunpharma__input-box mt-2">
                                                <input type="text" placeholder="" name="nominator_name">
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('nominator_name')) {?>
                                                    <?= $error = $validation->getError('nominator_name'); ?>
                                                <?php }?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">                                           
                                            <label for="" class="fw-bold">Mobile No (Nominator)</label>
                                            <div class="get-sunpharma__input-box mt-2">
                                                <input type="number" placeholder="" name="nominator_mobile">
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('nominator_mobile')) {?>
                                                    <?= $error = $validation->getError('nominator_mobile'); ?>
                                                <?php }?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">                                           
                                            <label for="" class="fw-bold">Email ID (Nominator)</label>
                                            <div class="get-sunpharma__input-box mt-2">
                                                <input type="email" placeholder="" name="nominator_email">
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('nominator_email')) {?>
                                                    <?= $error = $validation->getError('nominator_email'); ?>
                                                <?php }?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-12">                                           
                                            <label for="" class="fw-bold">Office Address (Nominator)</label>
                                            <div class="get-sunpharma__comment-box comment-form__input-box mt-2">
                                                <textarea name="nominator_office_address" placeholder="Write a message" style="height:auto;"></textarea>
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('nominator_office_address')) {?>
                                                    <?= $error = $validation->getError('nominator_office_address'); ?>
                                                <?php }?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Attach Justification Letter in pdf format (for Sponsoring the Nomination duly signed by the Nominator, Max : 500 KB)	</label>
                                                <input class="form-control" name="justification_letter" type="file" id="formFile">
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('justification_letter')) {?>
                                                    <?= $error = $validation->getError('justification_letter'); ?>
                                                <?php }?>
                                                </small>                                            
                                            </div>                                           
                                            
                                        </div>

                                        
                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">Attach Indian Passport Copy in pdf format  (<i class="fas fa-file-pdf text-danger">if citizenship is NRI</i>)</label>
                                                <input class="form-control mb-3" name="passport" type="file" id="formFile2">                                            
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('passport')) {?>
                                                    <?= $error = $validation->getError('passport'); ?>
                                                <?php }?>
                                                </small>
                                            </div>                                       
                                        </div>
  
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="comment-form__btn-box">
                                                <button type="submit" class="thm-btn comment-form__btn">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                <!-- </form> -->
                            </div>
                        </div>
                    </div>
                </div>
                                                </form>
            </div>
        </section>
        <!--Form Page End-->

        

       