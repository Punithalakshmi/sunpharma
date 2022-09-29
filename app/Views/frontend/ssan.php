<!--Page Header Start-->
        <section class="page-header">
        <div class="page-header-bg" style="background-image: url(<?=base_url();?>/frontend/assets/images/backgrounds/page-header-bg-ssan.jpg)">
            </div>
            <div class="page-header-shape-1"><img src="<?=base_url();?>/frontend/assets/images/shapes/page-header-shape-1.png" alt=""></div>
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
                                <!-- <form action="assets/inc/sendemail.php" class="comment-one__form contact-form-validated" novalidate="novalidate"> -->
                                    <div class="row">
                                        <div class="col-xl-6">                                           
                                            <label for="" class="fw-bold">Name of the Applicant</label>
                                            <div class="get-sunpharma__input-box mt-2">
                                                <input type="text" class="form-control my-3" placeholder="" name="nominee_name" value="<?=set_value('nominee_name',$editdata['nominee_name']);?>">
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('nominee_name')) {?>
                                                    <?= $error = $validation->getError('nominee_name'); ?>
                                                <?php }?>
                                                </small>
                                            </div>
                                            
                                        </div>

                                        <div class="col-xl-6">
                                           <div class="get-sunpharma__input-box mt-2">
                                                <label for="" class="fw-bold">Category of the Award</label>
                                                <select class="selectpicker mt-2"
                                                    aria-label="Default select example" name="category">
                                                    <option selected>-- select --</option>
                                                    
                                                    <?php if(is_array($categories)):
                                                          foreach($categories as $ckey=>$cvalue):?>
                                                    <option value="<?=$cvalue['id'];?>" <?=set_select('category',$cvalue['id'], ((isset($editdata['category']) && ($editdata['category']==$cvalue['id']))?TRUE:FALSE));?>><?=$cvalue['name'];?></option>
                                                    <?php endforeach; endif; ?> 
                                                </select>
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('category')) {?>
                                                    <?= $error = $validation->getError('category'); ?>
                                                <?php }?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">                                           
                                            <label for="" class="fw-bold">Date of Birth</label>
                                            <div class="get-sunpharma__input-box mt-2">
                                                <input type="date" class="form-control my-3" placeholder="" name="date_of_birth" value="<?=set_value('date_of_birth',$editdata['date_of_birth']);?>">
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('date_of_birth')) {?>
                                                    <?= $error = $validation->getError('date_of_birth'); ?>
                                                <?php }?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                        <div class="get-sunpharma__input-box mt-2">
                                                <label for="" class="fw-bold">Citizenship</label>
                                                <select class="selectpicker mt-2"
                                                    aria-label="Default select example" name="citizenship" value="<?=set_value('citizenship',$editdata['citizenship']);?>">
                                                    <option selected>-- Select --</option>
                                                    <option value="1" <?=set_select('citizenship', 1, ((isset($editdata['citizenship']) && ($editdata['citizenship']==1))?TRUE:FALSE));?>>Indian</option>
                                                    <option value="2" <?=set_select('citizenship', 2, ((isset($editdata['citizenship']) && ($editdata['citizenship']==2))?TRUE:FALSE));?>>Other</option>
                                                </select>
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('citizenship')) {?>
                                      
                                                        <?= $error = $validation->getError('citizenship'); ?>
                                                
                                                    <?php }?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                        <div class="get-sunpharma__input-box mt-2">
                                                <label for="" class="fw-bold">&nbsp;<br />Ongoing Course </label>
                                                <select class="selectpicker mt-2" aria-label="Default select example">
                                                    <option selected>-- select --</option>
                                                </select>
                                                <small class="text-danger">
                                                   
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                        <div class="get-sunpharma__input-box mt-2">
                                                <label for="" class="fw-bold">Whether the applicant has completed a Research Project</label>
                                                <select class="selectpicker mt-2" aria-label="Default select example">
                                                  <option selected>-- select --</option>
                                                </select>
                                                <small class="text-danger">
                                                   
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <label for="" class="fw-bold">Office Address</label>
                                            <div class="get-sunpharma__comment-box comment-form__input-box text-message-box mt-2">
                                                <textarea name="designation_and_office_address" placeholder="Write a message"><?=$editdata['designation_and_office_address'];?></textarea>
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
                                            <textarea name="residence_address" placeholder="Write a message"><?=$editdata['residence_address'];?></textarea>
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('residence_address')) {?>
                                                    <?= $error = $validation->getError('residence_address'); ?>
                                                <?php }?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">                                           
                                            <label for="" class="fw-bold">Mobile No</label>
                                            <div class="get-sunpharma__input-box mt-2">
                                            <input type="number" placeholder="" name="mobile_no" value="<?=set_value('mobile_no',$editdata['mobile_no']);?>">
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('mobile_no')) {?>
                                                    <?= $error = $validation->getError('mobile_no'); ?>
                                                <?php }?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">                                           
                                            <label for="" class="fw-bold">Email ID</label>
                                            <div class="get-sunpharma__input-box mt-2">
                                            <input type="email" placeholder="" name="email" value="<?=set_value('email',$editdata['email']);?>">
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('email')) {?>
                                                    <?= $error = $validation->getError('email'); ?>
                                                <?php }?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">                                           
                                            <label for="" class="fw-bold">Name of the Nominator</label>
                                            <div class="get-sunpharma__input-box mt-2">
                                                <input type="text" placeholder="" name="nominator_name" value="<?=set_value('nominator_name',$editdata['nominator_name']);?>">
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
                                                <input type="number" placeholder="" name="nominator_mobile" value="<?=set_value('nominator_mobile',$editdata['nominator_mobile']);?>">
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
                                            <input type="email" placeholder="" name="nominator_email" value="<?=set_value('nominator_email',$editdata['nominator_email']);?>">
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
                                            <textarea name="nominator_office_address" placeholder="Write a message" style="height:auto;"><?=$editdata['nominator_office_address'];?></textarea>
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('nominator_office_address')) {?>
                                                    <?= $error = $validation->getError('nominator_office_address'); ?>
                                                <?php }?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Attach Letter in pdf <i class="fas fa-file-pdf text-danger"></i> from the supervisor certifying that the research work submitted for Sun Pharma Science Scholar Award has actually been done by the applicant (Max : 500 KB)	</label>
                                                <input class="form-control" name="supervisor_certifying" type="file" id="formFile">
                                                <small class="text-danger">
                                                    <?php if(isset($validation) && $validation->getError('supervisor_certifying')) {?>
                                                        <?= $error = $validation->getError('supervisor_certifying'); ?>
                                                    <?php }?>   
                                                </small>                                        
                                            </div>                                           
                                            
                                        </div>

                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">Attach Justification Letter in pdf <i class="fas fa-file-pdf text-danger"></i> format (for Sponsoring the Nomination duly signed by the Nominator/Supervisor (Max : 500 KB))</label>
                                                <input class="form-control" name="justification_letter" type="file" id="formFile">
                                                <small class="text-danger">
                                                    <?php if(isset($validation) && $validation->getError('justification_letter')) {?>
                                                        <?= $error = $validation->getError('justification_letter'); ?>
                                                    <?php }?>   
                                                </small>
                                            </div>                                       
                                        </div>

                                        <?php if(isset($userdata['isNominee']) && ($userdata['isNominee'] == 'yes')): ?>
                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">Complete Bio-data of the applicant(Max: 1.5MB) pdf format</label>
                                                <input class="form-control mb-3" name="complete_bio_data" type="file" id="formFile2">                                            
                                                <!-- <small class="text-danger">
                                                <?php //if(isset($validation) && $validation->getError('passport')) {?>
                                                    <? //$error = $validation->getError('passport'); ?>
                                                <?php // }?>
                                                </small> -->
                                            </div>                                       
                                        </div>

                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">In Order of Importance list of 10 best papers of the applicant highlighting the important discoveries/contribution described in them briefly.(Max 1 MB)</label>
                                                <input class="form-control mb-3" name="best_papers" type="file" id="formFile2">                                            
                                                <!-- <small class="text-danger">
                                                <?php //if(isset($validation) && $validation->getError('passport')) {?>
                                                    <? //$error = $validation->getError('passport'); ?>
                                                <?php //}?>
                                                </small> -->
                                            </div>                                       
                                        </div>

                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">Statement of Research Achievements, if any, on which any Award has already been Received by the Applicant. Please also upload brief citations on the research works for which the applicant has already received the awards (Max: 1 MB)</label>
                                                <input class="form-control mb-3" name="statement_of_research_achievements" type="file" id="formFile2">                                            
                                                <!-- <small class="text-danger">
                                                <?php //if(isset($validation) && $validation->getError('passport')) {?>
                                                    <? //$error = $validation->getError('passport'); ?>
                                                <?php //}?>
                                                </small> -->
                                            </div>                                       
                                        </div>

                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">Signed details of the excellence in research work for which the Sun Pharma Research Award is claimed, including references and illustrations. The candidate should duly sign on the details. (Max: 2.5 MB)</label>
                                                <input class="form-control mb-3" name="signed_details" type="file" id="formFile2">                                            
                                                <!-- <small class="text-danger">
                                                <?php //if(isset($validation) && $validation->getError('passport')) {?>
                                                    <? //$error = $validation->getError('passport'); ?>
                                                <?php //}?>
                                                </small> -->
                                            </div>                                       
                                        </div>

                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">Two specific publications/research papers of the applicant relevent to the research work mentioned above.(Max: 2.5MB)</label>
                                                <input class="form-control mb-3" name="specific_publications" type="file" id="formFile2">                                            
                                                <!-- <small class="text-danger">
                                                <?php //if(isset($validation) && $validation->getError('passport')) {?>
                                                    <? //$error = $validation->getError('passport'); ?>
                                                <?php //}?>
                                                </small> -->
                                            </div>                                       
                                        </div>

                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">A signed statement by the applicant that the research work under reference has not been given any award. The applicant should also indicate the extent of the contribution of the others associated with the research and he/she should clearly acknowledge his/her achievements (Max: 500KB) </label>
                                                <input class="form-control mb-3" name="signed_statement" type="file" id="formFile2">                                            
                                                <!-- <small class="text-danger">
                                                <?php //if(isset($validation) && $validation->getError('passport')) {?>
                                                    <? //$error = $validation->getError('passport'); ?>
                                                <?php //}?>
                                                </small> -->
                                            </div>                                       
                                        </div>

                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">Citation on the Research Work of the Applicant duly signed by the Naminator(Max: 300 KB)</label>
                                                <input class="form-control mb-3" name="citation" type="file" id="formFile2">                                            
                                                <!-- <small class="text-danger">
                                                <?php //if(isset($validation) && $validation->getError('passport')) {?>
                                                    <? //$error = $validation->getError('passport'); ?>
                                                <?php //}?>
                                                </small> -->
                                            </div>                                       
                                        </div>
                                    <?php endif; ?>
  
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