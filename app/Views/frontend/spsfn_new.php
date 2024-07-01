<div id="formReplace">
<section class="bg-primary-gradient">
<div class="container py-5">
    <div class="row mx-auto" style="padding-bottom: 15px">
        <div class="col-lg-12">
            <h2 class="text-capitalize fw-normal text-start text-center" style="color: #f7941e;
            font-size: 1.6rem;
            font-weight: bold!important;">Sun Pharma Science Scholars Fellowships-<?=date('Y');?><br>Online Submission of Nominations
            </h2>
        </div>
    </div>
  
    <?php if(isset($uri) && ($uri == 'ssan' || $uri == 'spsfn')): ?>
         <?= script_tag('frontend/assets/js/jqueryValidate.js'); ?>
        <?= script_tag('frontend/assets/js/jQuerySteps.js'); ?>
        <?= script_tag('frontend/assets/js/additionalMethods.js'); ?>
        <?= script_tag('frontend/assets/js/jQuerydatepicker.js'); ?>


    <?php  endif;?>
    
    <form name="science_scholar_awards" id="science_scholar_awards" method="POST" action="<?=base_url();?>/spsfn" enctype="multipart/form-data">
    <?= csrf_field(); ?> 
    <input type="hidden" name="id" value="<?=(isset($editdata['id']))?$editdata['id']:"";?>" >
        <input type="hidden" name="detail_id" value="<?=(isset($editdata['detail_id']))?$editdata['detail_id']:"";?>" >
        <input type="hidden" name="formTypeStatus" value="submit">
        <input type="hidden" name="award_id" id="award_id" value="<?=$award_id;?>" >
        <div>
            <h3>Personal Info</h3>
            <section>
                <div class="step">
                 
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3 form-items form-items">
						<?php 
							//if(isset($validation))
                       					//   print_r($validation->getErrors());
 							?>
                                <div class="form-check ps-0 q-box">
                                    <div class="q-box__question col me-2">
                                        <label class="form-check-label question__label noLabel">
                                            <div class="form-label mb-2 " for=""> 
                                                Photograph of the Applicant
                                                <span class="required" style="color:red;">*</span>
                                            </div>
                                            <img class="uploadPreview" src="<?=base_url();?>/frontend/assets/img/user--default-Image.png" width="200" height="200" />
                                            <input type="file" class="form-control required" accept="image/*" name="nominator_photo" id="nominator_photo"  />
                                            <?php if(isset($editdata['nominator_photo_name']) && !empty($editdata['nominator_photo_name'])): ?>
                                                <span id="nominator_pt_name"><?=$editdata['nominator_photo_name'];?></span>
                                            <?php endif;?>
                                            <input type="hidden" name="nominator_photo_uploaded_file" id="nominator_photo_uploaded_file" value="<?=(isset($editdata['nominator_photo']) && !empty($editdata['nominator_photo']))?$editdata['nominator_photo']:'';?>" />
                                           </label>
                                        <div class="hintcont">
                                            <small>Not more than 500 KB,Upload file format .png, For example: sample.png</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="mb-3 form-items">
                                    <label class="form-label ">Category of the Fellowship<span class="required" style="color:red;">*</span></label>
                                    <select class="form-control required" name="category" id="category">
                                    <option value="">-- Select --</option>
                                       <?php if(is_array($categories)):
                                               foreach($categories as $ckey=>$cvalue):?>
                                         <option value="<?=$cvalue['id'];?>" <?=set_select('category',$cvalue['id'], ((isset($editdata['category']) && ($editdata['category']==$cvalue['id']))?TRUE:FALSE));?>><?=$cvalue['name'];?></option>
                                        <?php   endforeach; 
                                                endif; ?>     
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 form-items">
                                    <label class="form-label ">Name of the Applicant<span class="required" style="color:red;">*</span></label>
                                    <input class="form-control required" id="nominee_name" name="nominee_name" type="text" placeholder="" value="<?=set_value('nominee_name',$editdata['nominee_name']);?>">
                                </div>
                            </div>

                  
                            <div class="col-lg-12">
                                <div class=" mb-3 form-items">
                                    <label class="form-label ">Date of Birth<span class="required" style="color:red;">*</span></label>
                                    <input min="01/01/1992" max="07/31/2022" class="form-control required" data-provide="datepicker" id="date_of_birth" name="date_of_birth" value="<?=set_value('date_of_birth',$editdata['date_of_birth']);?>" placeholder="MM/DD/YYYY">
                                    <div class="hintcont">
                                        <small>Date Format: MM/DD/YYYY (Age should be less than 30 years as on July 01, 2022)</small>
                                    </div>
					<!--<div class="mb-3 form-items">Age</label>
                                    <input class="form-control" id="age" name="age" type="number" readonly value="" placeholder="Age">
                                </div>-->
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3 form-items">
                                <label class="form-label ">Citizenship<span class="required" style="color:red;">*</span></label>
                                <select class="form-control selectpicker mt-2 required"
                                    aria-label="Default select example" id="citizenship" name="citizenship" value="<?=set_value('citizenship',$editdata['citizenship']);?>">
                                    <option value="">-- Select --</option>
                                    <option value="1" <?=set_select('citizenship', 1, ((isset($editdata['citizenship']) && ($editdata['citizenship']==1))?TRUE:FALSE));?>>Indian</option>
                                    <!--<option value="2" <?//set_select('citizenship', 2, ((isset($editdata['citizenship']) && ($editdata['citizenship']==2))?TRUE:FALSE));?>>Other</option>-->
                                </select>
                                <small class="text-danger">
                                    <?php if(isset($validation) && $validation->getError('citizenship')) {?>
                                        <?= $error = $validation->getError('citizenship'); ?>
                                    <?php }?>
                                </small>
                                <div class="hintcont">
                                    <small>Indian / NRI (Holding valid Indian Passport–upload a copy of Passport)</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3 form-items">
                            <label for="" class="fw-bold">Ongoing Course <span class="required" style="color:red;">*</span></label>
                                <select class="form-control selectpicker mt-2 required" aria-label="Default select example" name="ongoing_course" id="ongoing_course" onChange="ongoingCourse(this);">
                                    <option value="">-- select --</option>
                                    <option value="MD" <?=set_select('ongoing_course', 'MD', ((isset($editdata['ongoing_course']) && ($editdata['ongoing_course']=='MD'))?TRUE:FALSE));?>>MD</option>
                                    <option value="PhD" <?=set_select('ongoing_course', 'PhD', ((isset($editdata['ongoing_course']) && ($editdata['ongoing_course']=='PhD'))?TRUE:FALSE));?>>PhD</option>
                                    <option value="other" <?=set_select('ongoing_course', 'other', ((isset($editdata['ongoing_course']) && ($editdata['ongoing_course']=='other'))?TRUE:FALSE));?>>Other</option>
                                </select>
                                                
                            </div>
                        </div>
                        
                        <div class="col-lg-6" id="courseName" style="display:none;">
                                <div class="mb-3 form-items">
                                    <label class="form-label " for="">Course Name</label>
                                    <input class="form-control" id="course_name" name="course_name" type="text" placeholder="" value="">
                                </div>
                            </div>

                        <div class="col-lg-6">
                            <div class="mb-3 form-items">
                            <label class="form-label ">Designation & Office Address<span class="required" style="color:red;">*</span></label>
                                <textarea class="form-control required" name="designation_and_office_address" id="designation_and_office_address" placeholder="Write a message"><?=$editdata['designation_and_office_address'];?></textarea>
                                <small class="text-danger">
                                    <?php if(isset($validation) && $validation->getError('designation_and_office_address')) {?>
                                        <?= $error = $validation->getError('designation_and_office_address'); ?>
                                    <?php }?>
                                </small>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3 form-items">
                                <label class="form-label ">Residence Address<span class="required" style="color:red;">*</span></label>
                                <textarea name="residence_address" class="form-control required" id="residence_address" placeholder="Write a message"><?=$editdata['residence_address'];?></textarea>
                                <small class="text-danger">
                                    <?php if(isset($validation) && $validation->getError('residence_address')) {?>
                                        <?= $error = $validation->getError('residence_address'); ?>
                                    <?php }?>
                                </small>

                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3 form-items">
                                <label class="fw-bold">Whether the applicant has completed a Research Project<span class="required" style="color:red;">*</span></label>
                                <select class="form-control selectpicker mt-2 required" aria-label="Default select example" name="research_project" id="research_project">
                                    <option value="">-- select --</option>
                                    <option value="Yes" <?=set_select('research_project', 'Yes', ((isset($editdata['research_project']) && ($editdata['research_project']=='Yes'))?TRUE:FALSE));?>>Yes</option>
                                    <option value="No" <?=set_select('research_project', 'No', ((isset($editdata['research_project']) && ($editdata['research_project']=='No'))?TRUE:FALSE));?>>No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3 form-items">
                                 <label class="form-label ">Mobile No.<span class="required" style="color:red;">*</span></label>
                                        
                                <input type="number" class="form-control required" placeholder="Please Enter Mobile No" id="mobile_no" name="mobile_no" value="<?=set_value('mobile_no',$editdata['mobile_no']);?>">
                                <small class="text-danger">
                                <?php if(isset($validation) && $validation->getError('mobile_no')) {?>
                                    <?= $error = $validation->getError('mobile_no'); ?>
                                <?php }?>
                                </small>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3 form-items">
                                <label class="form-label ">Email ID<span class="required" style="color:red;">*</span></label>
                                
                                <input type="email" class="form-control required" placeholder="Please Enter Email" id="nominee_email" name="email" value="<?=set_value('email',$editdata['email']);?>">
                                <small class="text-danger">
                                <?php if(isset($validation) && $validation->getError('email')) {?>
                                    <?= $error = $validation->getError('email'); ?>
                                <?php }?>
                                </small>
                            </div>
                       </div>
                    
                    </div>
                </div>
            </section>
            <h3>Nominator Info</h3>
            <section>
                <div class="step">
                   
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3 form-items">
                            <label class="form-label " >Name of the Nominator<span class="required" style="color:red;">*</span></label>
                            <input type="text" placeholder="" class="form-control required" name="nominator_name" id="nominator_name" value="<?=set_value('nominator_name',$editdata['nominator_name']);?>">
                            <small class="text-danger">
                                <?php if(isset($validation) && $validation->getError('nominator_name')) {?>
                                    <?= $error = $validation->getError('nominator_name'); ?>
                                <?php }?>
                            </small>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3 form-items">
                            <label class="form-label ">Designation & Office Address of the
                                Nominator<span class="required" style="color:red;">*</span></label>
                                <textarea class="form-control required" name="nominator_office_address" id="nominator_office_address" placeholder="Write a Address" style="height:auto;"><?=$editdata['nominator_office_address'];?></textarea>
                                <small class="text-danger">
                                <?php if(isset($validation) && $validation->getError('nominator_office_address')) {?>
                                    <?= $error = $validation->getError('nominator_office_address'); ?>
                                <?php }?>
                                </small>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3 form-items">
                                <label class="form-label ">Mobile No of the Nominator<span class="required" style="color:red;">*</span></label>
                                
                                <input  class="form-control required" type="number" placeholder="" id="nominator_mobile" name="nominator_mobile" value="<?=set_value('nominator_mobile',$editdata['nominator_mobile']);?>">
                                <small class="text-danger">
                                <?php if(isset($validation) && $validation->getError('nominator_mobile')) {?>
                                    <?= $error = $validation->getError('nominator_mobile'); ?>
                                <?php }?>
                                </small>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3 form-items">
                                <label class="form-label ">Email ID of the Nominator<span class="required" style="color:red;">*</span></label>
                            
                                <input type="email" class="form-control required" placeholder="" id="nominator_email" name="nominator_email" value="<?=set_value('nominator_email',$editdata['nominator_email']);?>">
                                <small class="text-danger">
                                <?php if(isset($validation) && $validation->getError('nominator_email')) {?>
                                    <?= $error = $validation->getError('nominator_email'); ?>
                                <?php }?>
                                </small>
                            </div>
                        </div>

                         
                        <div class="col-lg-12">
                            <div class="mb-3 form-items">
                                <label class="form-label "> Letter from the supervisor certifying that the research work submitted for Sun Pharma Science Scholar Fellowship has actually been done by the applicant(500 KB) <span class="required" style="color:red;">*</span></label>
                                <div class="form-check ps-0 q-box">
                                    <div class="q-box__question col me-2">
                                        <input class="form-control required" name="supervisor_certifying" accept=".pdf" type="file" id="supervisor_certifying" value="<?=$editdata['supervisor_certifying'];?>">
                                        <?php if(isset($editdata['supervisor_certifying_name']) && !empty($editdata['supervisor_certifying_name'])): ?>
                                            <span id="supervisor_certifying_nm"><?=$editdata['supervisor_certifying_name'];?></span>
                                        <?php endif;?>
                                        <input type="hidden" name="supervisor_certifying_uploaded_file" id="supervisor_certifying_uploaded_file" value="<?=(isset($editdata['supervisor_certifying']) && !empty($editdata['supervisor_certifying']))?$editdata['supervisor_certifying']:'';?>" />

                                        <small class="text-danger">
                                        <?php if(isset($validation) && $validation->getError('supervisor_certifying')) {?>
                                            <?= $error = $validation->getError('supervisor_certifying'); ?>
                                        <?php }?>
                                        </small>
                                        <div class="hintcont">
                                            <small>Upload (not more than 500KB),pdf format</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3 form-items">
                                <label class="form-label "> Attach Justification Letter in pdf format (for Sponsoring the Nomination duly signed by the Nominator, Max : 500 KB) <span class="required" style="color:red;">*</span></label>
                                <div class="form-check ps-0 q-box">
                                    <div class="q-box__question col me-2">
                                        <input class="form-control required" name="justification_letter" accept=".pdf" type="file" id="justification_letter" value="<?=$editdata['justification_letter'];?>">
                                        <?php if(isset($editdata['justification_letter_name']) && !empty($editdata['justification_letter_name'])): ?>
                                            <span id="justification_letter_nm"><?=$editdata['justification_letter_name'];?></span>
                                        <?php endif;?>
                                        <input type="hidden" name="justification_letter_uploaded_file" id="justification_letter_uploaded_file" value="<?=(isset($editdata['justification_letter']) && !empty($editdata['justification_letter']))?$editdata['justification_letter']:'';?>" />
                                        
                                        <small class="text-danger">
                                        <?php if(isset($validation) && $validation->getError('justification_letter')) {?>
                                            <?= $error = $validation->getError('justification_letter'); ?>
                                        <?php }?>
                                        </small>
                                        <div class="hintcont">
                                            <small>Upload Justification letter (not more than 500KB),pdf format</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </section>
        
<h3>Preview</h3>
<section>
   <div id="formPreview">
                                                    
   </div>                                                     
</section>
<!-- <h3>Finish</h3>
<section>
    
</section> -->
</div>
</form>
</div>
</section>
</div>