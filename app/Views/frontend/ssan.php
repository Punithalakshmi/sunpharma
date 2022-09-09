<!--Page Header Start-->
        <section class="page-header">
            <div class="page-header-bg" style="background-image: url(assets/images/backgrounds/page-header-bg.jpg)">
            </div>
            <div class="page-header-shape-1"><img src="assets/images/shapes/page-header-shape-1.png" alt=""></div>
            <div class="container">
                <div class="page-header__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="index.html">Home</a></li>
                        <li><span>/</span></li>
                        <li>SSAN</li>
                    </ul>
                    <h2>SSAN</h2>
                </div>
            </div>
        </section>
        <!--Page Header End-->

        <!--Form Page Start-->
        <?php if($nomination == 'no'){ ?>
            <div class="row">
                    <div class="col-12">
                        <h4 class="section-title__title mb-5">Nomination Registration - Closed
                        </h4>
                    </div>
                </div>
            <?php } else {?>
        <section class="contact-page">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="section-title__title mb-5">Nomination - Sun Pharma Science Foundation Science Scholar Awards 2022</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-lg-4">
                        <div class="contact-page__left">
                            <div class="m-card">
                                <div class="m-card-body text-center">
                                    <img src="<?=base_url();?>/frontend/assets/images/user--default-Image.png" class="img-fluid" alt="">
                                </div>
                                <div class="m-card-footer">
                                    <!-- <label for="formFile3" class="form-label">Attach </label> -->
                                    <input class="form-control my-3" type="file" id="formFile3">
                                    
                                    <small class="text-danger">
                                      
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8">
                        <div class="contact-page__right">
                            <div class="contact-page__form">
                                <!-- <form action="assets/inc/sendemail.php" class="comment-one__form contact-form-validated" novalidate="novalidate"> -->
                                    <div class="row">
                                        <div class="col-xl-6">                                           
                                            <label for="" class="fw-bold">Category of the Award</label>
                                            <div class="get-insurance__input-box mt-2">
                                                <input type="text" class="" placeholder="" name="name">
                                                <small class="text-danger">
                                                    
                                                </small>
                                            </div>
                                            
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="get-insurance__input-box">
                                                <label for="" class="fw-bold">Name of the Applicant</label>
                                                <select class="selectpicker mt-2"
                                                    aria-label="Default select example">
                                                    <option selected>-- select --</option>
                                                    <option value="1">Bio-Medical Sciences</option>
                                                    <option value="2">Pharmaceutical Sciences</option>
                                                </select>
                                                <small class="text-danger">
                                                    
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">                                           
                                            <label for="" class="fw-bold">Date of Birth</label>
                                            <div class="get-insurance__input-box mt-2">
                                                <input type="date" placeholder="" name="name">
                                                <small class="text-danger">
                                                    
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="get-insurance__input-box">
                                                <label for="" class="fw-bold">Citizenship</label>
                                                <select class="selectpicker mt-2"
                                                    aria-label="Default select example">
                                                    <option selected>-- select --</option>
                                                    <option value="1">Indian</option>
                                                    <option value="2">Other</option>
                                                </select>
                                                <small class="text-danger">
                                                  
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="get-insurance__input-box">
                                                <label for="" class="fw-bold">&nbsp;<br />Ongoing Course </label>
                                                <select class="selectpicker mt-2"
                                                    aria-label="Default select example">
                                                    <option selected>-- select --</option>
                                                </select>
                                                <small class="text-danger">
                                                   
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="get-insurance__input-box">
                                                <label for="" class="fw-bold">Whether the applicant has completed a Research Project</label>
                                                <select class="selectpicker mt-2"
                                                    aria-label="Default select example">
                                                    <option selected>-- select --</option>
                                                </select>
                                                <small class="text-danger">
                                                   
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <label for="" class="fw-bold">Office Address</label>
                                            <div class="get-insurance__comment-box comment-form__input-box text-message-box mt-2">
                                                <textarea name="message" placeholder="Write a message"></textarea>
                                                <small class="text-danger">
                                                  
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">                                           
                                            <label for="" class="fw-bold">Residence Address</label>
                                            <div class="get-insurance__comment-box comment-form__input-box text-message-box mt-2">
                                                <textarea name="message" placeholder="Write a message"></textarea>
                                                <small class="text-danger">
                                                  
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">                                           
                                            <label for="" class="fw-bold">Mobile No</label>
                                            <div class="get-insurance__input-box mt-2">
                                                <input type="number" placeholder="" name="name">
                                                <small class="text-danger">
                                                  
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">                                           
                                            <label for="" class="fw-bold">Email ID</label>
                                            <div class="get-insurance__input-box mt-2">
                                                <input type="email" placeholder="" name="name">
                                                <small class="text-danger">
                                                  
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">                                           
                                            <label for="" class="fw-bold">Name of the Nominator</label>
                                            <div class="get-insurance__input-box mt-2">
                                                <input type="text" placeholder="" name="name">
                                                <small class="text-danger">
                                                   
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">                                           
                                            <label for="" class="fw-bold">Mobile No (Nominator)</label>
                                            <div class="get-insurance__input-box mt-2">
                                                <input type="number" placeholder="" name="name">
                                                <small class="text-danger">
                                                  
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">                                           
                                            <label for="" class="fw-bold">Email ID (Nominator)</label>
                                            <div class="get-insurance__input-box mt-2">
                                                <input type="email" placeholder="" name="name">
                                                <small class="text-danger">
                                                   
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-12">                                           
                                            <label for="" class="fw-bold">Office Address (Nominator)</label>
                                            <div class="get-insurance__comment-box comment-form__input-box mt-2">
                                                <textarea name="message" placeholder="Write a message" style="height:auto;"></textarea>
                                                <small class="text-danger">
                                                    
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Attach Letter in pdf <i class="fas fa-file-pdf text-danger"></i> from the supervisor certifying that the research work submitted for Sun Pharma Science Scholar Award has actually been done by the applicant (Max : 500 KB)	</label>
                                                <input class="form-control" type="file" id="formFile">
                                                <small class="text-danger">
                                                 
                                                </small>                                            
                                            </div>                                           
                                            
                                        </div>

                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">Attach Justification Letter in pdf <i class="fas fa-file-pdf text-danger"></i> format (for Sponsoring the Nomination duly signed by the Nominator/Supervisor (Max : 500 KB)</label>
                                                <input class="form-control mb-3" type="file" id="formFile2">                                            
                                                <small class="text-danger">
                                                   
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
            </div>
        </section>
        <!--Form Page End-->     
        <?php } ?>