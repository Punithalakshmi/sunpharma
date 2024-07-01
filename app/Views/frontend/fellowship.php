<div id="formReplace">
<section class="bg-primary-gradient"><div class="container py-5">
    <div class="row mx-auto" style="padding-bottom: 15px">
        <div class="col-lg-12">
            <h2 class="text-capitalize fw-normal text-start text-center" style="color: #f7941e;
            font-size: 1.6rem;
            font-weight: bold!important;">Clinical Research Fellowship-<?=date('Y');?><br>
            </h2>
        </div>
    </div>
    
    <?php if(isset($uri) && ($uri == 'fellowship')): ?>
        <?= script_tag('frontend/assets/js/jqueryValidate.js'); ?>
        <?= script_tag('frontend/assets/js/jQuerySteps.js'); ?>
        <?= script_tag('frontend/assets/js/additionalMethods.js'); ?>
        <?= script_tag('frontend/assets/js/jQuerydatepicker.js'); ?>      
    <?php  endif;?>
  
    <form name="clinical_research_fellowship" id="formsection" method="POST" action="<?=base_url();?>/fellowship" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <input type="hidden" name="formTypeStatus" value="submit">
        <input type="hidden" name="id" value="<?=(isset($editdata['id']))?$editdata['id']:"";?>" >
        <input type="hidden" name="award_id" id="award_id" value="<?=$award_id;?>" >
        <input type="hidden" name="detail_id" value="<?=(isset($editdata['detail_id']))?$editdata['detail_id']:"";?>" >
        <div>
            <h3>Personal Info</h3>
            <section>
                <div class="step">
                 
                    <div class="row">
                       
			<div class="col-lg-12">
                                        <div class="mb-3 form-items">
                                             <div class="form-check ps-0 q-box">
                                                 <div class="q-box__question col me-2 d-flex">
                                                    <img class="uploadPreview" src="<?=base_url();?>/frontend/assets/img/user--default-Image.png" width="200" height="200" />
                                                    <div class="uploadsec">
                                                        <label class="form-check-label question__label noLabel">
                                                            <div class="form-label " for=""> Photograph of the Applicant</div>
                                                                <input name="nominator_photo"  accept="image/*" class="required" type="file" id="nominator_photo">
                                                                <small class="text-danger">
                                                                    <?php if(isset($validation) && $validation->getError('nominator_photo')) {?>
                                                                        <?= $error = $validation->getError('nominator_photo'); ?>
                                                                    <?php }?>
                                                                </small>
                                                        </label>
                                                        <div class="hintcont">
                                                            <small>Not more than 500 KB</small>
                                                            <br/>
                                                            <small id="nominatorPhotoErrMsg" style="color:red;font-family:bold;"></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="mb-3 form-items">
                                    <label class="form-label">Category of the Award <span class="required" style="color:red;">*</span></label>
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
                                    <label class="form-label">Name of the Applicant <span class="required" style="color:red;">*</span></label>
                                    <input class="form-control required" id="nominee_name" name="nominee_name" type="text" placeholder="" value="<?=set_value('nominee_name',$editdata['nominee_name']);?>">
                                </div>
                            </div>

                            <div class="col-lg-12">
                            <div class="mb-3 form-items">
                                <label class="form-label">Email ID <span class="required" style="color:red;">*</span></label>
                                
                                <input type="email" class="form-control required" placeholder="Please Enter Email" id="nominee_email" name="email" value="<?=set_value('email',$editdata['email']);?>">
                                <small class="text-danger">
                                <?php if(isset($validation) && $validation->getError('email')) {?>
                                    <?= $error = $validation->getError('email'); ?>
                                <?php }?>
                                </small>
                            </div>
                         </div>

                         <div class="col-lg-12">
                            <div class="mb-3 form-items">
                                <label class="form-label">Citizenship <span class="required" style="color:red;">*</span></label>
                                <select class="form-control selectpicker mt-2 required"
                                    aria-label="Default select example" id="citizenship" name="citizenship" value="<?=set_value('citizenship',$editdata['citizenship']);?>">
                                    <option value="">-- Select --</option>
                                    <option value="1" <?=set_select('citizenship', 1, ((isset($editdata['citizenship']) && ($editdata['citizenship']==1))?TRUE:FALSE));?>>Indian</option>
                                    <!-- <option value="2" <?//set_select('citizenship', 2, ((isset($editdata['citizenship']) && ($editdata['citizenship']==2))?TRUE:FALSE));?>>Other</option> -->
                                </select>
                                <small class="text-danger">
                                    <?php if(isset($validation) && $validation->getError('citizenship')) {?>
                                        <?= $error = $validation->getError('citizenship'); ?>
                                    <?php }?>
                                </small>
                               
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3 form-items">
                                 <label class="form-label">Mobile No. <span class="required" style="color:red;">*</span></label>
                                        
                                <input type="number" min="0" class="form-control required" placeholder="Please Enter Mobile No" id="mobile_no" name="mobile_no" value="<?=set_value('mobile_no',$editdata['mobile_no']);?>">
                                <small class="text-danger">
                                <?php if(isset($validation) && $validation->getError('mobile_no')) {?>
                                    <?= $error = $validation->getError('mobile_no'); ?>
                                <?php }?>
                                </small>
                            </div>
                        </div>
                        </div>

                        
                        <div class="col-lg-6">
                           <div class="col-lg-12">
                                <div class="mb-3 form-items">
                                    <label class="form-label" >Date of Birth <span class="required" style="color:red;">*</span></label>
                                    <input class="form-control required"  id="date_of_birth" name="date_of_birth" type="text" value="<?=set_value('date_of_birth',$editdata['date_of_birth']);?>" data-date-format="dd-mm-yyyy" placeholder="Date of Birth">
                                </div>
                                <div class="mb-3 form-items">Age <span class="required" style="color:red;">*</span></label>
                                    <input class="form-control" id="age" name="age" type="number" readonly value="" placeholder="Age">
                                </div>
                            </div> 
			<div class="col-lg-12">
                                <div class="mb-3 form-items minqual">
                                    <label class="form-label" >Minimum Qualification<span class="required" style="color:red;">*</span></label>
                                          <input type="radio" name="minimum_qualification" class="flat" value="MBBS" <?php echo set_radio('minimum_qualification','MBBS',(isset($editdata['minimum_qualification']) && ($editdata['minimum_qualification']=='MBBS'))?'checked':'');?> > MBBS
                         &nbsp;&nbsp;<input type="radio" name="minimum_qualification" class="flat" value="Other" <?php echo set_radio('minimum_qualification','Other',(isset($editdata['minimum_qualification']) && ($editdata['minimum_qualification']=='Other'))?'checked':'');?> > Other
                           </div>
                              </div>                      
                            <div class="col-lg-12">
                            <div class="mb-3 form-items">
                                <label class="form-label" >Residence Address <span class="required" style="color:red;">*</span></label>
                                <textarea name="residence_address" class="form-control required" id="residence_address" placeholder="Write a message"><?=$editdata['residence_address'];?></textarea>
                                <small class="text-danger">
                                    <?php if(isset($validation) && $validation->getError('residence_address')) {?>
                                        <?= $error = $validation->getError('residence_address'); ?>
                                    <?php }?>
                                </small>
                            </div>
                        </div> 

                        <div class="col-lg-12">
                            <div class="mb-3 form-items">
                            <label class="form-label">Designation & Office Address(Correspondence) <span class="required" style="color:red;">*</span></label>
                                <textarea class="form-control required" name="designation_and_office_address" id="designation_and_office_address" placeholder="Write a message"><?=$editdata['designation_and_office_address'];?></textarea>
                                <small class="text-danger">
                                    <?php if(isset($validation) && $validation->getError('designation_and_office_address')) {?>
                                        <?= $error = $validation->getError('designation_and_office_address'); ?>
                                    <?php }?>
                                </small>
                            </div>
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
                            <label class="form-label">Name of the Nominator <span class="required" style="color:red;">*</span></label>
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
                            <label class="form-label">Office Address  <span class="required" style="color:red;">*</span></label>
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
                            <label class="form-label">Designation  <span class="required" style="color:red;">*</span></label>
                                <textarea class="form-control required" name="nominator_designation" id="nominator_designation" placeholder="Write a Address" style="height:auto;"><?=$editdata['nominator_designation'];?></textarea>
                                <small class="text-danger">
                                <?php if(isset($validation) && $validation->getError('nominator_designation')) {?>
                                    <?= $error = $validation->getError('nominator_designation'); ?>
                                <?php }?>
                                </small>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3 form-items">
                                <label class="form-label">Mobile No.<span class="required" style="color:red;">*</span></label>
                                
                                <input  class="form-control required" min="0" type="number" placeholder="" id="nominator_mobile" name="nominator_mobile" value="<?=set_value('nominator_mobile',$editdata['nominator_mobile']);?>">
                                <small class="text-danger">
                                <?php if(isset($validation) && $validation->getError('nominator_mobile')) {?>
                                    <?= $error = $validation->getError('nominator_mobile'); ?>
                                <?php }?>
                                </small>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3 form-items">
                                <label class="form-label">Email ID<span class="required" style="color:red;">*</span></label>
                            
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
                                <label class="form-label"> Justification for Sponsoring the Nomination duly signed by the Nominator <span class="required" style="color:red;">*</span> (not to exceed 400 words) </label>
                                <div class="form-check ps-0 q-box">
                                    <div class="q-box__question col me-2">
                                        <input class="form-control required" name="justification_letter" type="file" id="justification_letter" value="<?=$editdata['justification_letter'];?>" accept="application/pdf">
                                        
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
                                            <small>Undertaking from your present employer that you will be allowed to avail of the Sun Pharma Science Foundation Clinical Research Fellowship, if awarded, under the terms and conditions announced by the Sun Pharma Science Foundation.(not more than 500KB)</small>
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