<div id="formReplace">
<section class="bg-primary-gradient"><div class="container py-5">
    <div class="row mx-auto" style="padding-bottom: 15px">
        <div class="col-lg-12">
            <h2 class="text-capitalize fw-normal text-start text-center" style="color: #f7941e;
            font-size: 1.6rem;
            font-weight: bold!important;">Sun Pharma Science Foundation Research Fellowships -<?=date('Y');?><br>Online Submission of Nominations
            </h2>
        </div>
    </div>
    
    <?php if(isset($uri) && ($uri == 'ssan' || $uri == 'spsfn')): ?>
        <?= script_tag('frontend/assets/js/jqueryValidate.js'); ?>
        <?= script_tag('frontend/assets/js/jQuerySteps.js'); ?>
        <?= script_tag('frontend/assets/js/additionalMethods.js'); ?>
        <?= script_tag('frontend/assets/js/jQuerydatepicker.js'); ?>
    <?php  endif;?>
  
    <form name="research_awards" id="formsection" method="POST" action="<?=base_url();?>/ssan" enctype="multipart/form-data">
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
                        <div class="col-lg-6">
                            <div class="mb-3 form-items form-items">

                                <div class="form-check ps-0 q-box">
                                    <div class="q-box__question col me-2">
                                        <label class="form-check-label question__label noLabel">
                                            <div class="form-label mb-2 " for=""> Photograph of the Applicant <span class="required" style="color:red;">*</span>
                                            </div>
                                            <img class="uploadPreview" src="<?=base_url();?>/frontend/assets/img/user--default-Image.png" width="200"
                                                height="200" />

                                               <input type="file" class="form-control required" accept="image/*" name="nominator_photo" id="nominator_photo" value="<?=set_value('nominator_photo',$editdata['nominator_photo']);?>" />
                                               <?php if(isset($editdata['nominator_photo_name']) && !empty($editdata['nominator_photo_name'])): ?>
                                                    <span id="nominator_pt_name"><?=$editdata['nominator_photo_name'];?></span>
                                                <?php endif;?>
                                               <input type="hidden" name="nominator_photo_uploaded_file" id="nominator_photo_uploaded_file" value="<?=(isset($editdata['nominator_photo']) && !empty($editdata['nominator_photo']))?$editdata['nominator_photo']:'';?>" />
                                        </label>
                                        <div class="hintcont">
                                            <small>Not more than 500 KB, Upload only filetype .png file For example: sample.png </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="mb-3 form-items">
                                    <label class="form-label " >Category of the Fellowship <span class="required" style="color:red;">*</span></label>
                                    <select class="form-control required" name="category" id="category">
                                    <option value="">-- Select --</option>
                                    <!-- <option value="Pharmaceutical Sciences" <?//set_select('category',"Pharmaceutical Sciences", ((isset($editdata['category']) && ($editdata['category']=='Pharmaceutical Sciences'))?TRUE:FALSE));?>>Pharmaceutical Sciences</option>
                                    <option value="Medical Sciences-Basic Research" <?//set_select('category',"Medical Sciences-Basic Research", ((isset($editdata['category']) && ($editdata['category']=='Medical Sciences-Basic Research'))?TRUE:FALSE));?>>Medical Sciences-Basic Research</option>
                                    <option value="Medical Sciences-Clinical Research" <?//set_select('category',"Medical Sciences-Clinical Research", ((isset($editdata['category']) && ($editdata['category']=='Medical Sciences-Clinical Research'))?TRUE:FALSE));?>>Medical Sciences-Clinical Research</option> -->
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
                                    <label class="form-label" >Name of the Applicant <span class="required" style="color:red;">*</span></label>
                                    <input class="form-control required" id="nominee_name" name="nominee_name" type="text" placeholder="" value="<?=set_value('nominee_name',$editdata['nominee_name']);?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 form-items">
                                    <label class="form-label ">Date of Birth <span class="required" style="color:red;">*</span></label>
                                    <input class="form-control required" id="date_of_birth" name="date_of_birth" type="text" value="<?=set_value('date_of_birth',$editdata['date_of_birth']);?>"
                                        placeholder="MM/DD/YYYY">

                                    <div class="hintcont">
                                        <small>Date Format: MM/DD/YYYY</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        <div class="col-lg-6">
                            <div class="mb-3 form-items">
                                <label class="form-label " >Residence Address <span class="required" style="color:red;">*</span></label>
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
                            <label class="form-label ">Designation & Office Address <span class="required" style="color:red;">*</span></label>
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
                                 <label class="form-label ">Mobile No. <span class="required" style="color:red;">*</span></label>
                                        
                                <input type="number" min="0" class="form-control required" placeholder="Please Enter Mobile No" id="mobile_no" name="mobile_no" value="<?=set_value('mobile_no',$editdata['mobile_no']);?>">
                                <small class="text-danger">
                                <?php if(isset($validation) && $validation->getError('mobile_no')) {?>
                                    <?= $error = $validation->getError('mobile_no'); ?>
                                <?php }?>
                                </small>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3 form-items">
                                <label class="form-label ">Email ID <span class="required" style="color:red;">*</span></label>
                                
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
                                <label class="form-label ">Citizenship <span class="required" style="color:red;">*</span></label>
                                <select class="form-control selectpicker mt-2 required"
                                    aria-label="Default select example" id="citizenship" name="citizenship" value="<?=set_value('citizenship',$editdata['citizenship']);?>">
                                    <option value="">-- Select --</option>
                                    <option value="1" <?=set_select('citizenship', 1, ((isset($editdata['citizenship']) && ($editdata['citizenship']==1))?TRUE:FALSE));?>>Indian</option>
                                    <option value="2" <?=set_select('citizenship', 2, ((isset($editdata['citizenship']) && ($editdata['citizenship']==2))?TRUE:FALSE));?>>Other</option>
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
                        
                    
                    </div>
                </div>
            </section>
            <h3>Nominator Info</h3>
            <section>
                <div class="step">
                   
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3 form-items">
                            <label class="form-label ">Name of the Nominator <span class="required" style="color:red;">*</span></label>
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
                                Nominator <span class="required" style="color:red;">*</span></label>
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
                                <label class="form-label ">Mobile No of the Nominator <span class="required" style="color:red;">*</span></label>
                                
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
                                <label class="form-label ">Email ID of the Nominator <span class="required" style="color:red;">*</span></label>
                            
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
                                <label class="form-label "> Attach Justification Letter in pdf format <span class="required" style="color:red;">*</span> (for Sponsoring the Nomination duly signed by the Nominator, Max : 500 KB) </label>
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
                                            <small>Upload Justification letter (not more than 500KB), pdf format</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                        <div class="mb-3 form-items">
                            <label class="form-label"> 
                                Attach Indian Passport Copy in pdf format   (<i class="fas fa-file-pdf text-danger">if citizenship is NRI</i>)
                            </label>
                            <div class="form-check ps-0 q-box">
                                <div class="q-box__question col me-2">
                                    <input class="form-control mb-3" name="passport" type="file" id="passport" value="<?=$editdata['passport'];?>" accept=".pdf">                                            
                                    <?php if(isset($editdata['passport_name']) && !empty($editdata['passport_name'])): ?>
                                            <span id="passport_nm"><?=$editdata['passport_name'];?></span>
                                        <?php endif;?>
                                        <input type="hidden" name="passport_uploaded_file" id="passport_uploaded_file" value="<?=(isset($editdata['passport']) && !empty($editdata['passport']))?$editdata['passport']:'';?>" />

                                  
                                    <small class="text-danger">
                                        <?php if(isset($validation) && $validation->getError('passport')) {?>
                                            <?= $error = $validation->getError('passport'); ?>
                                        <?php }?>
                                    </small>
                                    <div class="hintcont">
                                        <small>Upload Passport (not more than 500KB), pdf format</small>
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