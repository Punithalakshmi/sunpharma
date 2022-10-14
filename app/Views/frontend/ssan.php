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
        <?php  if($nomination == 'no'){ ?>
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
                <form name="science_scholar_awards" id="science_scholar_awards" method="POST" action="<?=base_url();?>/ssan" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=(isset($editdata['id']))?$editdata['id']:"";?>" >
                <input type="hidden" name="detail_id" value="<?=(isset($editdata['detail_id']))?$editdata['detail_id']:"";?>" >
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
                           
                                <input type="hidden" name="id" value="<?=(isset($editdata['id']))?$editdata['id']:"";?>" >
                                <input type="hidden" name="detail_id" value="<?=(isset($editdata['detail_id']))?$editdata['detail_id']:"";?>" >
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
                                                    <option value="">-- select --</option>
                                                    
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
                                                <input type="text" class="form-control my-3" placeholder="" name="date_of_birth" value="<?=set_value('date_of_birth',$editdata['date_of_birth']);?>">
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
                                                    <option value="">-- Select --</option>
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
                                                <select class="selectpicker mt-2" aria-label="Default select example" name="ongoing_course">
                                                    <option value="">-- select --</option>
                                                    <option value="MD" <?=set_select('ongoing_course', 1, ((isset($editdata['ongoing_course']) && ($editdata['ongoing_course']=='MD'))?TRUE:FALSE));?>>MD</option>
                                                    <option value="PhD" <?=set_select('ongoing_course', 1, ((isset($editdata['ongoing_course']) && ($editdata['ongoing_course']=='PhD'))?TRUE:FALSE));?>>PhD</option>
                                                    <option value="other" <?=set_select('ongoing_course', 1, ((isset($editdata['ongoing_course']) && ($editdata['ongoing_course']=='other'))?TRUE:FALSE));?>>Other</option>
                                                </select>
                                                <small class="text-danger">
                                                   
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                        <div class="get-sunpharma__input-box mt-2">
                                                <label for="" class="fw-bold">Whether the applicant has completed a Research Project</label>
                                                <select class="selectpicker mt-2" aria-label="Default select example" name="research_project">
                                                  <option value="">-- select --</option>
                                                  <option value="Yes" <?=set_select('research_project', 1, ((isset($editdata['research_project']) && ($editdata['research_project']=='Yes'))?TRUE:FALSE));?>>Yes</option>
                                                  <option value="No" <?=set_select('research_project', 1, ((isset($editdata['research_project']) && ($editdata['research_project']=='No'))?TRUE:FALSE));?>>No</option>
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
                                                <label for="formFile" class="form-label">Letter from the supervisor certifying that the research work submitted for Sun Pharma Science Scholar Award has actually been done by the applicant(500 KB)</label>
                                                <input class="form-control" name="supervisor_certifying" type="file" id="formFile">
                                                <?php if(!empty($editdata['supervisor_certifying'])): ?> 
                                                         <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['supervisor_certifying'];?>" style="color:blue;"><?=$editdata['supervisor_certifying'];?></a>                                        
                                                    <?php endif;?> 
                                                <small class="text-danger">
                                                    <?php if(isset($validation) && $validation->getError('supervisor_certifying')) {?>
                                                        <?= $error = $validation->getError('supervisor_certifying'); ?>
                                                    <?php }?>   
                                                </small>                                        
                                            </div>                                           
                                            
                                        </div>

                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">Justification for Sponsoring the Nomination duly signed by the Nominator/Supervisor(500 KB) </label>
                                                <input class="form-control" name="justification_letter" type="file" id="formFile">
                                                <?php if(!empty($editdata['justification_letter'])): ?> 
                                                         <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['justification_letter'];?>" style="color:blue;"><?=$editdata['justification_letter'];?></a>                                        
                                                    <?php endif;?> 
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
                                                <label for="formFile2" class="form-label">Complete Bio-data of the applicant(Max: 1MB) pdf format</label>
                                                <input class="form-control mb-3" name="complete_bio_data" type="file" id="formFile2">
                                                <?php if(!empty($editdata['complete_bio_data'])): ?> 
                                                         <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['complete_bio_data'];?>" style="color:blue;"><?=$editdata['complete_bio_data'];?></a>                                        
                                                    <?php endif;?>                                             
                                                <!-- <small class="text-danger">
                                                <?php //if(isset($validation) && $validation->getError('passport')) {?>
                                                    <? //$error = $validation->getError('passport'); ?>
                                                <?php // }?>
                                                </small> -->
                                            </div>                                       
                                        </div>

                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">Details of the excellence in research work for which the Sun Pharma Science Scholar Award is claimed, including references and illustrations with following headings- Title, Introduction, Objectives, Materials and Methods, Results, Statistical Analysis, Discussion, Impact of the research in the advancement of knowledge or benefit to mankind, Literature reference. The candidate should duly sign on the details.(Max 2 MB)</label>
                                                <input class="form-control mb-3" name="excellence_research_work" type="file" id="formFile2">                                            
                                                <?php if(!empty($editdata['excellence_research_work'])): ?> 
                                                         <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['excellence_research_work'];?>" style="color:blue;"><?=$editdata['excellence_research_work'];?></a>                                        
                                                <?php endif;?> 
                                                <!-- <small class="text-danger">
                                                <?php //if(isset($validation) && $validation->getError('passport')) {?>
                                                    <? //$error = $validation->getError('passport'); ?>
                                                <?php //}?>
                                                </small> -->
                                            </div>                                       
                                        </div>

                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">List of Publications, if any. If yes, Upload copies of any two publications (Max: 2 MB)</label>
                                                <input class="form-control mb-3" name="lists_of_publications" type="file" id="formFile2">                                            
                                                <?php if(!empty($editdata['lists_of_publications'])): ?> 
                                                         <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['lists_of_publications'];?>" style="color:blue;"><?=$editdata['lists_of_publications'];?></a>                                        
                                                <?php endif;?>
                                                <!-- <small class="text-danger">
                                                <?php //if(isset($validation) && $validation->getError('passport')) {?>
                                                    <? //$error = $validation->getError('passport'); ?>
                                                <?php //}?>
                                                </small> -->
                                            </div>                                       
                                        </div>

                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">Statement of Merits/Awards/Scholarships already received by the Applicant (Max: 1 MB)</label>
                                                <input class="form-control mb-3" name="statement_of_applicant" type="file" id="formFile2">                                            
                                                <?php if(!empty($editdata['statement_of_applicant'])): ?> 
                                                         <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['statement_of_applicant'];?>" style="color:blue;"><?=$editdata['statement_of_applicant'];?></a>                                        
                                                <?php endif;?>
                                                <!-- <small class="text-danger">
                                                <?php //if(isset($validation) && $validation->getError('passport')) {?>
                                                    <? //$error = $validation->getError('passport'); ?>
                                                <?php //}?>
                                                </small> -->
                                            </div>                                       
                                        </div>

                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">A letter stating that the project submitted for the award has received “ethical clearance” (Max: 250KB)</label>
                                                <input class="form-control mb-3" name="ethical_clearance" type="file" id="formFile2">                                            
                                                <?php if(!empty($editdata['ethical_clearance'])): ?> 
                                                         <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['ethical_clearance'];?>" style="color:blue;"><?=$editdata['ethical_clearance'];?></a>                                        
                                                <?php endif;?>
                                                <!-- <small class="text-danger">
                                                <?php //if(isset($validation) && $validation->getError('passport')) {?>
                                                    <? //$error = $validation->getError('passport'); ?>
                                                <?php //}?>
                                                </small> -->
                                            </div>                                       
                                        </div>

                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">A statement duly signed by the nominee and the supervisor/co-author that academically or financially the thesis submitted for Sun Pharma Science Scholar Award-2021 has “non-conflict of interest” with the supervisor or co-authors (Max: 250KB) </label>
                                                <input class="form-control mb-3" name="statement_of_duly_signed_by_nominee" type="file" id="formFile2">                                            
                                                <?php if(!empty($editdata['statement_of_duly_signed_by_nominee'])): ?> 
                                                         <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['statement_of_duly_signed_by_nominee'];?>" style="color:blue;"><?=$editdata['statement_of_duly_signed_by_nominee'];?></a>                                        
                                                <?php endif;?>
                                                <!-- <small class="text-danger">
                                                <?php //if(isset($validation) && $validation->getError('passport')) {?>
                                                    <? //$error = $validation->getError('passport'); ?>
                                                <?php //}?>
                                                </small> -->
                                            </div>                                       
                                        </div>

                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">Citation (brief summary) on the Research Work of the Applicant duly signed by the Nominator (Max: 300 KB)</label>
                                                <input class="form-control mb-3" name="citation" type="file" id="formFile2">                                            
                                                <?php if(!empty($editdata['citation'])): ?> 
                                                         <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['citation'];?>" style="color:blue;"><?=$editdata['citation'];?></a>                                        
                                                <?php endif;?>
                                                <!-- <small class="text-danger">
                                                <?php //if(isset($validation) && $validation->getError('passport')) {?>
                                                    <? //$error = $validation->getError('passport'); ?>
                                                <?php //}?>
                                                </small> -->
                                            </div>                                       
                                        </div>

                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">Aggregate marks obtained in PCB/PCM in Class XII or any other course (Max: 250 KB)</label>
                                                <input class="form-control mb-3" name="aggregate_marks" type="file" id="formFile2">                                            
                                                <?php if(!empty($editdata['aggregate_marks'])): ?> 
                                                         <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['aggregate_marks'];?>" style="color:blue;"><?=$editdata['aggregate_marks'];?></a>                                        
                                                <?php endif;?>
                                                <!-- <small class="text-danger">
                                                <?php //if(isset($validation) && $validation->getError('passport')) {?>
                                                    <? //$error = $validation->getError('passport'); ?>
                                                <?php //}?>
                                                </small> -->
                                            </div>                                       
                                        </div>

                                        <div class="col-xl-12">                                           
                                            <label for="" class="fw-bold">Year of Passing</label>
                                            <div class="get-sunpharma__input-box mt-2">
                                                <input type="text" placeholder="" name="year_of_passing" value="<?=set_value('year_of_passing',$editdata['year_of_passing']);?>">
                                                
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('year_of_passing')) {?>
                                                    <?= $error = $validation->getError('year_of_passing'); ?>
                                                <?php }?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-12">                                           
                                            <label for="" class="fw-bold">Number of Attempts</label>
                                            <div class="get-sunpharma__input-box mt-2">
                                                <input type="number" placeholder="" name="number_of_attempts" value="<?=set_value('number_of_attempts',$editdata['number_of_attempts']);?>">
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('number_of_attempts')) {?>
                                                    <?= $error = $validation->getError('number_of_attempts'); ?>
                                                <?php }?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">Age proof (Max: 250KB)</label>
                                                <input class="form-control mb-3" name="age_proof" type="file" id="formFile2">                                            
                                                <?php if(!empty($editdata['age_proof'])): ?> 
                                                         <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['age_proof'];?>" style="color:blue;"><?=$editdata['age_proof'];?></a>                                        
                                                <?php endif;?>
                                                <!-- <small class="text-danger">
                                                <?php //if(isset($validation) && $validation->getError('passport')) {?>
                                                    <? //$error = $validation->getError('passport'); ?>
                                                <?php //}?>
                                                </small> -->
                                            </div>                                       
                                        </div>

                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">A voluntary declaration from the candidate that they would work in the public or private funded academic/research based organizations for a minimum period of two years after completion of his/her studies. (Max: 250KB)</label>
                                                <input class="form-control mb-3" name="declaration_candidate" type="file" id="formFile2">                                            
                                                <?php if(!empty($editdata['declaration_candidate'])): ?> 
                                                         <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['declaration_candidate'];?>" style="color:blue;"><?=$editdata['declaration_candidate'];?></a>                                        
                                                <?php endif;?>
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
                                 </form> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Form Page End-->     
        <?php } ?>