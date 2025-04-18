<!--Page Header Start-->
        <section class="page-header">
            <div class="page-header-bg" style="background-image: url(<?=base_url();?>/frontend/assets/images/backgrounds/page-header-bg.jpg)">
            </div>
            <div class="page-header-shape-1"><img src="<?=base_url();?>/frontend/assets/images/shapes/page-header-shape-1.png" alt=""></div>
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
        <?php //if(isset($validation)) {//echo "<pre>"; //print_r($validation);}?>
        <!--Form Page Start-->
        <?php if($nomination == 'no'){ ?>
            <div class="row">
                    <div class="col-12">
                        <h4 class="section-title__title mb-5">Nomination Registration - Closed
                        </h4>
                    </div>
                </div>
            <?php } else { //print_r($userdata); ?>
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
                <input type="hidden" name="id" value="<?=(isset($editdata['id']))?$editdata['id']:"";?>" >
                <input type="hidden" name="detail_id" value="<?=(isset($editdata['detail_id']))?$editdata['detail_id']:"";?>" >
                <?php if(session()->getFlashdata('msg')):?>
                    <div class="col-xl-3 col-lg-4" style="color:green;font-size:14px;">
                        <?= session()->getFlashdata('msg') ?>
                    </div>
                <?php endif;?>
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
                                    <div class="row">
                                    
                                        <div class="col-xl-6">                                           
                                            <label for="" class="fw-bold">Category of the Award</label>
                                            <div class="get-sunpharma__input-box mt-2">
                                                
                                                <select class="selectpicker mt-2"
                                                    aria-label="Default select example" name="category">
                                                    <option selected>-- Select --</option>
                                                    <?php if(is_array($categories)):
                                                          foreach($categories as $ckey=>$cvalue):?>
                                                    <option value="<?=$cvalue['id'];?>" <?=set_select('category',$cvalue['id'], ((isset($editdata['category']) && ($editdata['category']==$cvalue['id']))?TRUE:FALSE));?>><?=$cvalue['name'];?></option>
                                                    <?php endforeach; endif; ?>                                                </select>
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
                                                <input type="text" class="" placeholder="" name="nominee_name" value="<?=set_value('nominee_name',$editdata['nominee_name']);?>">
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('nominee_name')) {?>
                                      
                                                        <?= $error = $validation->getError('nominee_name'); ?>
                                                
                                                <?php }?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">                                           
                                            <label for="" class="fw-bold">Date of Birth</label>
                                            <?php //echo $editdata['date_of_birth']; ?>
                                            <div class="get-sunpharma__input-box mt-2">
                                                <input type="text" placeholder="" name="date_of_birth" value="<?=set_value('date_of_birth',$editdata['date_of_birth']);?>">
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
                                            <label for="" class="fw-bold">Designation & Office Address</label>
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
                                                <label for="formFile" class="form-label">Attach Justification Letter in pdf format (for Sponsoring the Nomination duly signed by the Nominator, Max : 500 KB)	</label>
                                                
                                                <input class="form-control" name="justification_letter" type="file" id="formFile" value="<?=$editdata['justification_letter'];?>">
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

                                        
                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">Attach Indian Passport Copy in pdf format  (<i class="fas fa-file-pdf text-danger">if citizenship is NRI</i>)</label>
                                                
                                                <input class="form-control mb-3" name="passport" type="file" id="formFile2" value="<?=$editdata['passport'];?>">                                            
                                               
                                                <?php if(!empty($editdata['passport'])): ?>
                                                    <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['passport'];?>" style="color:blue;"><?=$editdata['passport'];?></a>
                                                <?php endif;?> 
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('passport')) {?>
                                                    <?= $error = $validation->getError('passport'); ?>
                                                <?php }?>
                                                </small>
                                                
                                            </div>                                       
                                        </div>
                             <?php if(isset($userdata['isNominee']) && ($userdata['isNominee'] == 'yes')): ?>
                                        
                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">Complete Bio-data of the applicant(Max: 1.5MB) pdf format</label>
                                                
                                                    <input class="form-control mb-3" name="complete_bio_data" type="file" id="formFile2" value="<?=$editdata['complete_bio_data'];?>">   
                                                    <?php if(!empty($editdata['complete_bio_data'])): ?> 
                                                         <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['complete_bio_data'];?>" style="color:blue;"><?=$editdata['complete_bio_data'];?></a>                                        
                                                    <?php endif;?> 
                                                    <!-- <small class="text-danger">
                                                            <?php //if(isset($validation) && $validation->getError('complete_bio_data')) {?>
                                                                <? //$error = $validation->getError('complete_bio_data'); ?>
                                                            <?php // }?>
                                                        </small> -->
                                                
                                            </div>                                       
                                        </div>

                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">In Order of Importance list of 10 best papers of the applicant highlighting the important discoveries/contribution described in them briefly.(Max 1 MB)</label>
                                                
                                                 <input class="form-control mb-3" name="best_papers" type="file" id="formFile2" value="<?=$editdata['best_papers'];?>">  
                                                 <?php if(!empty($editdata['best_papers'])): ?>
                                                 <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['best_papers'];?>" style="color:blue;"><?=$editdata['best_papers'];?></a>    
                                                 <?php endif;?>                                      
                                                    <!-- <small class="text-danger">
                                                        <?php //if(isset($validation) && $validation->getError('best_papers')) {?>
                                                            <? //$error = $validation->getError('best_papers'); ?>
                                                        <?php //}?>
                                                    </small>  -->
                                                
                                            </div>                                       
                                        </div>

                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">Statement of Research Achievements, if any, on which any Award has already been Received by the Applicant. Please also upload brief citations on the research works for which the applicant has already received the awards (Max: 1 MB)</label>
                                                
                                                  <input class="form-control mb-3" name="statement_of_research_achievements" type="file" id="formFile2" value="<?=$editdata['statement_of_research_achievements'];?>"> 
                                                  <?php if(!empty($editdata['statement_of_research_achievements'])): ?>
                                                    <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['statement_of_research_achievements'];?>" style="color:blue;"><?=$editdata['statement_of_research_achievements'];?></a>                                           
                                                  <?php endif;?>
                                                  <!-- <small class="text-danger">
                                                <?php //if(isset($validation) && $validation->getError('statement_of_research_achievements')) {?>
                                                    <? //$error = $validation->getError('statement_of_research_achievements'); ?>
                                                <?php //}?>
                                                </small>  -->
                                                 
                                            </div>                                       
                                        </div>

                                        <div class="col-xl-12">    
                                            <div class="mb-3">
                                                <label for="formFile2" class="form-label">Signed details of the excellence in research work for which the Sun Pharma Research Award is claimed, including references and illustrations. The candidate should duly sign on the details. (Max: 2.5 MB)</label>
                                                
                                                <input class="form-control mb-3" name="signed_details" type="file" id="formFile2" value="<?=$editdata['signed_details'];?>">    
                                                <?php if(!empty($editdata['signed_details'])): ?>
                                                   <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['signed_details'];?>" style="color:blue;"><?=$editdata['signed_details'];?></a>                                        
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
                                                <label for="formFile2" class="form-label">Two specific publications/research papers of the applicant relevent to the research work mentioned above.(Max: 2.5MB)</label>
                                                
                                                <input class="form-control mb-3" name="specific_publications" type="file" id="formFile2" value="<?=$editdata['specific_publications'];?>">  
                                                <?php if(!empty($editdata['specific_publications'])): ?>
                                                    <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['specific_publications'];?>" style="color:blue;"><?=$editdata['specific_publications'];?></a>                                          
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
                                                <label for="formFile2" class="form-label">A signed statement by the applicant that the research work under reference has not been given any award. The applicant should also indicate the extent of the contribution of the others associated with the research and he/she should clearly acknowledge his/her achievements (Max: 500KB) </label>
                                                
                                                <input class="form-control mb-3" name="signed_statement" type="file" id="formFile2" value="<?=$editdata['signed_statement'];?>">   
                                                <br />
                                                <?php if(!empty($editdata['signed_statement'])): ?>
                                                <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['signed_statement'];?>" style="color:blue;"><?=$editdata['signed_statement'];?></a>                                         
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
                                                <label for="formFile2" class="form-label">Citation on the Research Work of the Applicant duly signed by the Naminator(Max: 300 KB)</label>
                                                
                                                <input class="form-control mb-3" name="citation" type="file" id="formFile2" value="<?=$editdata['citation'];?>">   
                                                <br>
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
                                    <?php endif; ?>

                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="comment-form__btn-box">
                                                <button type="submit" class="thm-btn comment-form__btn">Submit</button>
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

        
<?php }?>
       