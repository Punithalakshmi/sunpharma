
<section class="bg-primary-gradient"><!-- CONTAINER -->
    <div id="mainform-container" class="container py-1 ">
    <div class="row mt-4 mx-auto" style="padding-bottom: 5px">
        <div class="col-lg-12">
            
            <a class="btn btn-info btn-light" href="javascript:history.back()">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="-128 0 512 512" width="1em" height="1em" fill="currentColor">
            <path d="M192 448c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L77.25 256l137.4 137.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448z"></path>
        </svg> Back</a>
        
      <h2 class="text-capitalize fw-normal text-start text-center" style="color: #2d2d2d;
            font-size: 1.6rem;
            font-weight: bold!important;">
                 <?php
                    $type = 'Clinical Research Fellowship';
                 ?>
               <?php if(isset($userdata['nominationEndDays']) && $userdata['nominationEndDays'] > 0): ?>
                 Clinical Research Fellowship - <?=date('Y');?>
               
                <?php endif;?>
            </h2>
        </div>
    </div>
    <div class="row">
       <?php 
       if(isset($userdata['nominationEndDays']) && $userdata['nominationEndDays'] <= 0): ?>
          <h4>Nomination was closed you just view your data. you can't able to update the data</h4>
        <?php endif;?>
        <!-- FORMS -->
        <div id="mainform-items" class="col-lg-12 mx-0 px-0">
            <div class="progress">
                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="50"
                    class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                    style="width: 0%; background-color:#f6911f; opacity: .5"></div>
            </div>
            
            <div id="qbox-container">
            <form method="post" name="nomination_data" action="<?=base_url();?>/fellowship/view" enctype="multipart/form-data">
            <?= csrf_field(); ?>   
            <input type="hidden" name="id" value="<?=(isset($editdata['id']) && !empty($editdata['id']))?$editdata['id']:"";?>" />
                    <div id="steps-container">
                        <div class="step">

                            <div class="row">
                                <?php if(isset($user['nominator_photo']) && !empty($user['nominator_photo'])): ?>
				<div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                    <div class="form-check ps-0 q-box">
                                      <div class="q-box__question col me-2 d-flex">     
                                        <label class="form-check-label question__label noLabel">
                                            <div class="form-label mb-2"> <b>Photograph of the Applicant </b></div>
                                              <img class="uploadPreview" src="<?=base_url();?>/uploads/<?=date('Y');?>/CRF/<?=$user['user_id'];?>/<?=$user['nominator_photo'];?>" width="200" height="200" />                                                    </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
				<?php endif;?>
                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""><b>Category</b></label>
                                        <div><?=$user['category_name'];?>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""><b>Name of the Applicant</b></label>
                                        <div><?=$user['firstname'].' '.$user['lastname'];?>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""><b>Date of Birth</b></label>
                                        <div><?=$user['dob'];?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> <b>Citizenship </b></label>
                                        <div>
                                        <?=($user['citizenship']==1)?'Indian':'Other';?>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="step">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""><b>Designation & Office Address</b></label>
                                        <div>
                                        <?=$user['address'];?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""><b>Residence Address</b> </label>
                                            <div>
                                            <?=$user['residence_address'];?>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""><b>Mobile No.</b></label>
                                        <div><?=$user['phone'];?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""><b>Email ID</b></label>
                                        <div><?=$user['email'];?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="step">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""><b>Name of the Nominator</b></label>
                                        <div><?=$user['nominator_name'];?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">
                                                 <b>Office Address</b>
                                          </label>
                                            <div >
                                            <?=$user['nominator_address'];?>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">
                                                 <b>Designation</b>
                                          </label>
                                            <div >
                                            <?=$user['nominator_designation'];?></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""><b>Mobile No</b></label>
                                        <div><?=$user['nominator_phone'];?></div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""><b>Email ID</b></label>
                                        <div>
                                           <?=$user['nominator_email'];?>
                                        </div>
                                    </div>
                                </div>
                               
                                <?php 
                                
                                 if(isset($user['justification_letter_filename']) && !empty($user['justification_letter_filename'])): ?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> <b>Justification for Sponsoring the
                                            Nomination duly signed by the Nominator (not to exceed 400 words) </b> </label>
                                            <div >
                                                <a href="<?=base_url();?>/uploads/<?=date('Y');?>/CRF/<?=$user['user_id'];?>/<?=$user['justification_letter_filename'];?>" target="_blank">
                                                  <button class="btn btn-primary btn-sm" type="button">
                                                    <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                    </svg> View
                                                  </button>
                                               </a>
                                            </div>
                                    </div>
                                </div>
                               <?php
                                 endif;
                              ?>

		                <?php 
                                
                                 if(empty($user['nominator_photo'])): ?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> <b>Applicant Photo:</b> </label>
                                            <div>
						<input type="file" class="form-control required" accept="image/*" name="nominator_photo" id="nominator_photo" value="<?=set_value('nominator_photo',$editdata['nominator_photo']);?>" />
						<?php if(isset($editdata['nominator_photo_name']) && !empty($editdata['nominator_photo_name'])): ?>
                                                    <span id="nominator_photo_nm"><?=$editdata['nominator_photo_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="nominator_photo_file" id="nominator_photo_file" value="<?=(isset($editdata['nominator_photo']) && !empty($editdata['nominator_photo']))?$editdata['nominator_photo']:'';?>" />
                                          </div>
                                    </div>
                                </div>
                               <?php endif;
                              ?>

				
                            </div>
                        </div>
                  	
                        
                        <div class="step">

                            <div class="row">
                            <?php if(isset($userdata['nominationEndDays']) && $userdata['nominationEndDays'] > 0): ?>
                                <?php if(!empty($user['complete_bio_data'])): ?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        
                                            
                                            <label class="form-label" for=""><b>Complete Bio-data of the Applicant
                                            (Max 1.5 MB) </b></label>
                                            <div>
                                              <a href="<?=base_url();?>/uploads/<?=date('Y');?>/CRF/<?=$user['user_id'];?>/<?=$user['complete_bio_data'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                              </svg> View
                                            </button>
                                            </a>
                                            </div>
                                            
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                      <label class="form-label " for=""> <b>Complete Bio-data of the Applicant
                                            (Max 1.5 MB) </b><span class="required" style="color:red;">*</span></label>
                                            <div>
                                                <input class="form-control mb-3 required" accept=".pdf" name="complete_bio_data" type="file" id="complete_bio_data" value="<?=$editdata['complete_bio_data'];?>">   
                                                <?php if(isset($editdata['complete_letter_name']) && !empty($editdata['complete_letter_name'])): ?>
                                                    <span id="complete_letter_nm"><?=$editdata['complete_letter_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="justification_letter_uploaded_file" id="justification_letter_uploaded_file" value="<?=(isset($editdata['justification_letter']) && !empty($editdata['justification_letter']))?$editdata['justification_letter']:'';?>" />
                                                
                                                <div class="">
                                                    <small>Upload the Bio-data (Not more than 1.5 MB)</small>
                                                </div>
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('complete_bio_data')) {?>
                                                <?= $error = $validation->getError('complete_bio_data'); ?>
                                            <?php }?>
                                            </small>
                                    </div>
                                </div>
				

                                <?php  
                                    endif;
                                   if(isset($user) && ($user['nomination_type'] == 'fellowship') ):
                                    
                                ?>
                                <?php if(!empty($user['first_employment_name_of_institution_location']) || !empty($user['first_employment_designation']) || !empty($user['first_employment_year_of_joining'])): ?> 
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                       
                                            <label class="form-label"><b>First employment</b> </label>
                                            <br>
                                        
                                       
                                            <?php if(!empty($user['first_employment_name_of_institution_location'])): ?>
                                            <label class="form-label " for=""><b> Name of institution and location</b>  </label>
                                                <div>
                                                     <?=(isset($user['first_employment_name_of_institution_location']) && !empty($user['first_employment_name_of_institution_location']))?$user['first_employment_name_of_institution_location']:'';?>
                                               </div>
                                            <?php endif;?>
                                            <br/>
                                            <?php if(!empty($user['first_employment_designation'])): ?>
                                            <label class="form-label " for=""><b> Designation </b></label>
                                                <div>
                                                     <?=(isset($user['first_employment_designation']) && !empty($user['first_employment_designation']))?$user['first_employment_designation']:'';?>
                                               </div>
                                            <?php endif;?>
                                            <br />
                                            <?php if(!empty($user['first_employment_year_of_joining'])): ?>
                                            <label class="form-label " for=""> <b>Year of joining </b> </label>
                                                <div>
                                                     <?=(isset($user['first_employment_year_of_joining']) && !empty($user['first_employment_year_of_joining']))?$user['first_employment_year_of_joining']:'';?>
                                               </div>
                                            <?php endif;?>
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label"><b>First employment</b> </label>
                                            <br>
                                        <div>
                                                <label class="form-check-label question__label noLabel"><b>Name of institution and location </b><span class="required" style="color:red;">*</span> </label>
                                                <input class="form-control mb-3 required"  name="first_employment_name_of_institution_location" type="text" id="first_employment_name_of_institution_location" value="<?php echo set_value('first_employment_name_of_institution_location',$editdata['first_employment_name_of_institution_location']);?>">    
                                        </div>
                                        <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('first_employment_name_of_institution_location')) {?>
                                                <?= $error = $validation->getError('first_employment_name_of_institution_location'); ?>
                                            <?php }?>
                                        </small>

                                    </div>
                                    <div class="mb-3 form-items">
                                        <div>
                                                <label class="form-check-label question__label noLabel"><b>Designation</b> <span class="required" style="color:red;">*</span> </label>
                                                <input class="form-control mb-3 required" name="first_employment_designation" type="text" id="first_employment_designation" value="<?php echo set_value('first_employment_designation',$editdata['first_employment_designation']);?>" >    
                                        </div>
                                        <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('first_employment_designation')) {?>
                                                <?= $error = $validation->getError('first_employment_designation'); ?>
                                            <?php }?>
                                        </small>
                                        
                                    </div>
                                    <div class="mb-3 form-items">
                                        <div>
                                                <label class="form-check-label question__label noLabel"><b>Year of joining </b><span class="required" style="color:red;">*</span> </label>
                                                <input class="form-control mb-3 required" name="first_employment_year_of_joining" type="text" id="first_employment_year_of_joining" value="<?php echo set_value('first_employment_year_of_joining',$editdata['first_employment_year_of_joining']);?>" >    
                                        </div>
                                        <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('first_employment_year_of_joining')) {?>
                                                <?= $error = $validation->getError('first_employment_year_of_joining'); ?>
                                            <?php }?>
                                        </small>
                                        
                                    </div>
                                </div>
                               <?php endif;?>
                               <?php if(!empty($user['first_medical_degree_name_of_degree']) || !empty($user['first_medical_degree_year_of_award']) || !empty($user['first_medical_degree_institution'])): ?>                     
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        
                                            <label class="form-label"><b>First medical degree obtained: </b> </label>
                                            <br>
                                       
                                     
                                        <?php if(!empty($user['first_medical_degree_name_of_degree'])): ?>
                                            <label class="form-label " for=""> <b> Name of degree </b>  </label>
                                                <div>
                                                     <?=(isset($user['first_medical_degree_name_of_degree']) && !empty($user['first_medical_degree_name_of_degree']))?$user['first_medical_degree_name_of_degree']:'';?>
                                               </div>
                                            <?php endif;?>
                                            <br/>
                                            <?php if(!empty($user['first_medical_degree_year_of_award'])): ?>
                                            <label class="form-label " for=""><b> Year of award of degree </b></label>
                                                <div>
                                                     <?=(isset($user['first_medical_degree_year_of_award']) && !empty($user['first_medical_degree_year_of_award']))?$user['first_medical_degree_year_of_award']:'';?>
                                               </div>
                                            <?php endif;?>
                                            <br />
                                            <?php if(!empty($user['first_medical_degree_institution'])): ?>
                                            <label class="form-label " for=""> <b> Institution awarding the degree </b> </label>
                                                <div>
                                                     <?=(isset($user['first_medical_degree_institution']) && !empty($user['first_medical_degree_institution']))?$user['first_medical_degree_institution']:'';?>
                                               </div>
                                            <?php endif;?>
                                            <?php if(!empty($user['first_degree_marksheet'])): ?>
                                            <label class="form-label " for=""> <b> Marksheet </b> </label>
                                                 <div>
                                                    <a href="<?=base_url();?>/uploads/<?=date('Y');?>/CRF/<?=$user['user_id'];?>/<?=$user['first_degree_marksheet'];?>" target="_blank">
                                                        <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                            <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                        </svg> View</button>
                                                    </a>
                                                </div>
                                            <?php endif;?>   
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                  <div class="mb-3 form-items">
                                  <label class="form-label"><b>First medical degree obtained: </b> </label>
                                            <br>
                                        <div>
                                                <label class="form-check-label question__label noLabel"><b>Name of degree </b> <span class="required" style="color:red;">*</span> </label>
                                                <input class="form-control mb-3 required" name="first_medical_degree_name_of_degree" type="text" id="first_medical_degree_name_of_degree" value="<?php echo set_value('first_medical_degree_name_of_degree',$editdata['first_medical_degree_name_of_degree']);?>">    
                                        </div>
                                        <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('first_medical_degree_name_of_degree')) {?>
                                                <?= $error = $validation->getError('first_medical_degree_name_of_degree'); ?>
                                            <?php }?>
                                        </small>

                                    </div>
                                    <div class="mb-3 form-items">
                                        <div>
                                                <label class="form-check-label question__label noLabel"><b>Year of award of degree </b> <span class="required" style="color:red;">*</span> </label>
                                                <input type="number" class="form-control mb-3 required" name="first_medical_degree_year_of_award" type="text" id="first_medical_degree_year_of_award" value="<?php echo set_value('first_medical_degree_year_of_award',$editdata['first_medical_degree_year_of_award']);?>" >    
                                        </div>
                                        <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('first_medical_degree_year_of_award')) {?>
                                                <?= $error = $validation->getError('first_medical_degree_year_of_award'); ?>
                                            <?php }?>
                                        </small>
                                        
                                    </div>
                                    <div class="mb-3 form-items">
                                        <div>
                                                <label class="form-check-label question__label noLabel"> <b>Institution awarding the degree </b> <span class="required" style="color:red;">*</span> </label>
                                                <input class="form-control mb-3 required" name="first_medical_degree_institution" type="text" id="first_medical_degree_institution" value="<?php echo set_value('first_medical_degree_institution',$editdata['first_medical_degree_institution']);?>" >    
                                        </div>
                                        <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('first_medical_degree_institution')) {?>
                                                <?= $error = $validation->getError('first_medical_degree_institution'); ?>
                                            <?php }?>
                                        </small>
                                    </div>
                                    <div class="mb-3 form-items">
                                        <div>
                                                <label class="form-check-label question__label noLabel"> <b>Marksheet </b> <span class="required" style="color:red;">*</span> </label>
                                                <input class="form-control mb-3 required" accept=".pdf" name="first_degree_marksheet" type="file" id="first_degree_marksheet" value="<?php echo set_value('first_degree_marksheet',$editdata['first_degree_marksheet']);?>">    
                                        </div>
                                        <?php if(isset($editdata['first_degree_marksheet_name']) && !empty($editdata['first_degree_marksheet_name'])): ?>
                                            <span id="first_degree_marksheet_nm"><?=$editdata['first_degree_marksheet_name'];?></span>
                                        <?php endif;?>
                                        <input type="hidden" name="justification_letter_uploaded_file" id="justification_letter_uploaded_file" value="<?=(isset($editdata['justification_letter']) && !empty($editdata['justification_letter']))?$editdata['justification_letter']:'';?>" />
                                        
                                        <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('first_degree_marksheet')) {?>
                                                <?= $error = $validation->getError('first_degree_marksheet'); ?>
                                            <?php }?>
                                        </small>
                                    </div>
                                </div>
                                <?php endif;?>

                                <?php if(!empty($user['highest_medical_degree_name']) || !empty($user['highest_medical_degree_year']) || !empty($user['highest_medical_degree_institution']) || !empty($user['highest_degree_marksheet'])): ?> 
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        
                                        <label class="form-label" for="">  <b>Highest medical degree obtained: </b> </label>
                                        <br>
                                       
                                        <?php if(!empty($user['highest_medical_degree_name'])): ?>
                                            <label class="form-label " for=""> <b> Name of degree </b>  </label>
                                                <div>
                                                     <?=(isset($user['highest_medical_degree_name']) && !empty($user['highest_medical_degree_name']))?$user['highest_medical_degree_name']:'';?>
                                               </div>
                                            <?php endif;?>
                                            <br/>
                                            <?php if(!empty($user['highest_medical_degree_year'])): ?>
                                            <label class="form-label " for=""> <b> Year of award of degree </b> </label>
                                                <div>
                                                     <?=(isset($user['highest_medical_degree_year']) && !empty($user['highest_medical_degree_year']))?$user['highest_medical_degree_year']:'';?>
                                               </div>
                                            <?php endif;?>
                                            <br />
                                            <?php if(!empty($user['highest_medical_degree_institution'])): ?>
                                            <label class="form-label " for=""> <b> Institution awarding the degree </b> </label>
                                                <div>
                                                     <?=(isset($user['highest_medical_degree_institution']) && !empty($user['highest_medical_degree_institution']))?$user['highest_medical_degree_institution']:'';?>
                                               </div>
                                            <?php endif;?>   
                                            <?php if(!empty($user['highest_degree_marksheet'])): ?>
                                            <label class="form-label " for=""> <b> Marksheet </b> </label>

                                                <div>
                                                        <a href="<?=base_url();?>/uploads/<?=date('Y');?>/CRF/<?=$user['user_id'];?>/<?=$user['highest_degree_marksheet'];?>" target="_blank">
                                                        <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                            <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                        </svg> View</button>
                                                    </a>
                                                </div>
                                            <?php endif;?>
                                               
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                  <div class="mb-3 form-items">
                                 
                                            <label class="form-label " for="">  <b>Highest medical degree obtained: </b> </label>
                                            <br>
                                     
                                        <div>
                                                <label class="form-check-label question__label noLabel"> <b> Name of degree </b> <span class="required" style="color:red;">*</span> </label>
                                                <input class="form-control mb-3 required"  name="highest_medical_degree_name" type="text" id="highest_medical_degree_name" value="<?php echo set_value('highest_medical_degree_name',$editdata['highest_medical_degree_name']);?>" >    
                                        </div>
                                         <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('highest_medical_degree_name')) {?>
                                                <?= $error = $validation->getError('highest_medical_degree_name'); ?>
                                            <?php }?>
                                         </small>

                                    </div>
                                    <div class="mb-3 form-items">
                                        <div>
                                                <label class="form-check-label question__label noLabel"><b> Year of award of degree </b> <span class="required" style="color:red;">*</span> </label>
                                                <input type="number" class="form-control mb-3 required" name="highest_medical_degree_year" type="text" id="highest_medical_degree_year" value="<?php echo set_value('highest_medical_degree_year',$editdata['highest_medical_degree_year']);?>" >    
                                        </div>
                                        <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('highest_medical_degree_year')) {?>
                                                <?= $error = $validation->getError('highest_medical_degree_year'); ?>
                                            <?php }?>
                                        </small>
                                        
                                    </div>
                                    <div class="mb-3 form-items">
                                        <div>
                                                <label class="form-check-label question__label noLabel"> <b> Institution awarding the degree </b> <span class="required" style="color:red;">*</span> </label>
                                                <input class="form-control mb-3 required" name="highest_medical_degree_institution" type="text" id="highest_medical_degree_institution" value="<?php echo set_value('highest_medical_degree_institution',$editdata['highest_medical_degree_institution']);?>" >    
                                        </div>
                                        <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('highest_medical_degree_institution')) {?>
                                                <?= $error = $validation->getError('highest_medical_degree_institution'); ?>
                                            <?php }?>
                                        </small>
                                    </div>
                                    <div class="mb-3 form-items">
                                        <div>
                                                <label class="form-check-label question__label noLabel"> <b>Marksheet</b> <span class="required" style="color:red;">*</span> </label>
                                                <input class="form-control mb-3 required" accept=".pdf" name="highest_degree_marksheet" type="file" id="highest_degree_marksheet" value="<?php echo set_value('highest_degree_marksheet',$editdata['highest_degree_marksheet']);?>" >    
                                        </div>
                                        <?php if(isset($editdata['highest_degree_marksheet_name']) && !empty($editdata['highest_degree_marksheet_name'])): ?>
                                                    <span id="highest_degree_marksheet_nm"><?=$editdata['highest_degree_marksheet_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="justification_letter_uploaded_file" id="justification_letter_uploaded_file" value="<?=(isset($editdata['justification_letter']) && !empty($editdata['justification_letter']))?$editdata['justification_letter']:'';?>" />
                                                
                                        <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('highest_degree_marksheet')) {?>
                                                <?= $error = $validation->getError('highest_degree_marksheet'); ?>
                                            <?php }?>
                                        </small>
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if(!empty($user['fellowship_research_experience'])): ?>                    
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        
                                            
                                                <label class="form-label " for=""> <b>Research Experience (including, summer research, hands-on research workshop, etc.) </b></label>
                                            <div>
                                            <a href="<?=base_url();?>/uploads/<?=date('Y');?>/CRF/<?=$user['user_id'];?>/<?=$user['fellowship_research_experience'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View</button>
</a>
                                            </div>
                                           
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                    <label class="form-label " for=""> <b>Research Experience (including, summer research, hands-on research workshop, etc.) </b><span class="required" style="color:red;">*</span></label>
                                            <div>
                                            <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" accept=".pdf" name="fellowship_research_experience" type="file" id="fellowship_research_experience" value="<?=$editdata['fellowship_research_experience'];?>">    
                                                    
                                                </label>
                                                <?php if(isset($editdata['fellowship_research_experience_name']) && !empty($editdata['fellowship_research_experience_name'])): ?>
                                                    <span id="fellowship_research_experience_nm"><?=$editdata['fellowship_research_experience_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="justification_letter_uploaded_file" id="justification_letter_uploaded_file" value="<?=(isset($editdata['justification_letter']) && !empty($editdata['justification_letter']))?$editdata['justification_letter']:'';?>" />
                                                
                                                <div class="">
                                                    <small>Upload document maximum 500KB</small>
                                                </div>
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('fellowship_research_experience')) {?>
                                                <?= $error = $validation->getError('fellowship_research_experience'); ?>
                                            <?php }?>
                                            </small>
                                    </div>
                                </div>
                               <?php endif;?>
                               <?php if(!empty($user['fellowship_research_publications'])): ?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                       
                                            
                                                <label class="form-label " for=""> <b> Research publications, if any, with complete details (title, journal name, volume number, pages, year, and/or other relevant information) </b></label>  
                                            <div>
                                            <a href="<?=base_url();?>/uploads/<?=date('Y');?>/CRF/<?=$user['user_id'];?>/<?=$user['fellowship_research_publications'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View</button>
</a>
                                            </div>
                                            
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                    <label class="form-label " for=""> <b> Research publications, if any, with complete details (title, journal name, volume number, pages, year, and/or other relevant information) </b> <span class="required" style="color:red;">*</span></label>
                                            <div>
                                                <label class="form-check-label question__label noLabel">
                                                  <input class="form-control mb-3 required" accept=".pdf" name="fellowship_research_publications" type="file" id="fellowship_research_publications" value="<?=$editdata['fellowship_research_publications'];?>">  
                                                </label>
                                                <?php if(isset($editdata['fellowship_research_publications_name']) && !empty($editdata['fellowship_research_publications_name'])): ?>
                                                    <span id="fellowship_research_publications_nm"><?=$editdata['fellowship_research_publications_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="justification_letter_uploaded_file" id="justification_letter_uploaded_file" value="<?=(isset($editdata['justification_letter']) && !empty($editdata['justification_letter']))?$editdata['justification_letter']:'';?>" />
                                                
                                                <div class="">
                                                    <small>Upload the document (Not more than 1MB)</small>
                                                </div>
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('fellowship_research_publications')) {?>
                                                <?= $error = $validation->getError('fellowship_research_publications'); ?>
                                            <?php }?>
                                            </small>
                                    </div>
                                </div>
                               <?php endif;?>
                               <?php if(!empty($user['fellowship_research_awards_and_recognitions'])): ?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        
                                            
                                                <label class="form-label " for=""> <b>Awards and Recognitions (such as, Young Scientist Award of a science or a medical academy or a national association of the applicant's specialty) </b></label>
                                            <div>
                                            <a href="<?=base_url();?>/uploads/<?=date('Y');?>/CRF/<?=$user['user_id'];?>/<?=$user['fellowship_research_awards_and_recognitions'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View
                                             </button>
</a>
                                            </div>
                                            
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                    <label class="form-label " for=""> <b>Awards and Recognitions (such as, Young Scientist Award of a science or a medical academy or a national association of the applicant's specialty) </b> <span class="required" style="color:red;">*</span></label>
                                            <div>
                                            <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" accept=".pdf" name="fellowship_research_awards_and_recognitions" type="file" id="fellowship_research_awards_and_recognitions" value="<?=$editdata['fellowship_research_awards_and_recognitions'];?>">   
                                                    <br />
                                                   
                                                </label>
                                                <?php if(isset($editdata['fellowship_research_awards_and_recognitions_name']) && !empty($editdata['fellowship_research_awards_and_recognitions_name'])): ?>
                                                    <span id="fellowship_research_awards_and_recognitions_nm"><?=$editdata['fellowship_research_awards_and_recognitions_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="justification_letter_uploaded_file" id="justification_letter_uploaded_file" value="<?=(isset($editdata['justification_letter']) && !empty($editdata['justification_letter']))?$editdata['justification_letter']:'';?>" />
                                                
                                                <div class="">
                                                    <small>Upload the document (Not more than 500 KB) </small>
                                                </div>
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('fellowship_research_awards_and_recognitions')) {?>
                                                <?= $error = $validation->getError('fellowship_research_awards_and_recognitions'); ?>
                                            <?php }?>
                                            </small>
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if(!empty($user['fellowship_scientific_research_projects'])): ?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                          
                                            
                                                <label class="form-label " for=""> <b> Description of past scientific research projects completed and research experience (1 page) </b></label>
                                            <div>
                                            <a href="<?=base_url();?>/uploads/<?=date('Y');?>/CRF/<?=$user['user_id'];?>/<?=$user['fellowship_scientific_research_projects'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View
                                          </button>
</a>
                                            </div>
                                           
                                    </div>
                                    <?php endif;?>
                                    <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                    <label class="form-label " for=""> <b> Description of past scientific research projects completed and research experience (1 page) </b> <span class="required" style="color:red;">*</span></label>
                                            <div>
                                                  <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" accept=".pdf" name="fellowship_scientific_research_projects" type="file" id="fellowship_scientific_research_projects" value="<?=$editdata['fellowship_scientific_research_projects'];?>">   
                                                    <br>
                                                    
                                                </label>
                                                <?php if(isset($editdata['fellowship_scientific_research_projects_name']) && !empty($editdata['fellowship_scientific_research_projects_name'])): ?>
                                                    <span id="fellowship_scientific_research_projects_nm"><?=$editdata['fellowship_scientific_research_projects_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="justification_letter_uploaded_file" id="justification_letter_uploaded_file" value="<?=(isset($editdata['justification_letter']) && !empty($editdata['justification_letter']))?$editdata['justification_letter']:'';?>" />
                                                
                                                <div class="">
                                                    <small>Upload the document (Not more than 500KB) </small>
                                                </div>
                                                
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('fellowship_scientific_research_projects')) {?>
                                                <?= $error = $validation->getError('fellowship_scientific_research_projects'); ?>
                                            <?php }?>
                                            </small>
                                        </div>
                                    </div>
                                    <?php
                                       endif;
                                        ?>
                                        <?php if(!empty($user['fellowship_name_of_institution_research_work'])): ?>
                                        <div class="col-lg-12">
                                            <div class="mb-3 form-items">
                                         
                                              
                                                <label class="form-label " for=""> <b> Name of the institution in which research work on the <i>Sun Pharma Science Foundation Clinical Research Fellowship</i> will be carried out, if awarded: </b></label>
                                                <div>
                                                     <?=(isset($user['fellowship_name_of_institution_research_work']) && !empty($user['fellowship_name_of_institution_research_work']))?$user['fellowship_name_of_institution_research_work']:'';?>
                                               </div>
                                         
                                            <br/>
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                  <div class="mb-3 form-items">
                                  <label class="form-label " for=""> <b> Name of the institution in which research work on the <i>Sun Pharma Science Foundation Clinical Research Fellowship</i> will be carried out, if awarded: </b><span class="required" style="color:red;">*</span></label>
                                        <div>
                                            <input class="form-control mb-3 required" name="fellowship_name_of_institution_research_work" type="text" id="fellowship_name_of_institution_research_work" value="<?php echo set_value('fellowship_name_of_institution_research_work',$editdata['fellowship_name_of_institution_research_work']);?>" >    
                                        </div>
                                        <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('fellowship_name_of_institution_research_work')) {?>
                                                <?= $error = $validation->getError('fellowship_name_of_institution_research_work'); ?>
                                            <?php }?>
                                        </small>

                                    </div>
                                    
                                </div>
                                <?php endif;?>
                                <?php if(!empty($user['fellowship_name_of_the_supervisor'])): ?>                    
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        
                                        
                                            <label class="form-label " for=""> <b> If awarded, supervisor under whom research work on the <i>Sun Pharma Science Foundation Clinical Research Fellowship</i> will be carried out: </b> </label>
                                            <label class="form-label " for=""> <b> Name of supervisor </b>  </label>
                                                <div>
                                                     <?=(isset($user['fellowship_name_of_the_supervisor']) && !empty($user['fellowship_name_of_the_supervisor']))?$user['fellowship_name_of_the_supervisor']:'';?>
                                               </div>
                                            <?php endif;?>
                                            <br/>
                                            <?php if(!empty($user['fellowship_name_of_institution'])): ?>
                                            <label class="form-label " for=""> <b>Institution </b> </label>
                                                <div>
                                                     <?=(isset($user['fellowship_name_of_institution']) && !empty($user['fellowship_name_of_institution']))?$user['fellowship_name_of_institution']:'';?>
                                               </div>
                                            <?php endif;?>
                                            <br />
                                            <?php if(!empty($user['fellowship_supervisor_department'])): ?>
                                            <label class="form-label " for="">  <b> Department </b></label>
                                                <div>
                                                     <?=(isset($user['fellowship_supervisor_department']) && !empty($user['fellowship_supervisor_department']))?$user['fellowship_supervisor_department']:'';?>
                                               </div>
                                           
                                    </div>
                                </div>
                                <?php endif;?>   
                                <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                  <div class="mb-3 form-items">
                                  <label class="form-label " for=""> <b> If awarded, supervisor under whom research work on the <i>Sun Pharma Science Foundation Clinical Research Fellowship</i> will be carried out: </b> </label>
                                        <div>
                                                <label class="form-check-label question__label noLabel"> <b> Name of supervisor </b><span class="required" style="color:red;">*</span> </label>
                                                <input class="form-control mb-3 required" name="fellowship_name_of_the_supervisor" type="text" id="fellowship_name_of_the_supervisor" value="<?php echo set_value('fellowship_name_of_the_supervisor',$editdata['fellowship_name_of_the_supervisor']);?>">    
                                        </div>
                                        <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('fellowship_name_of_the_supervisor')) {?>
                                                <?= $error = $validation->getError('fellowship_name_of_the_supervisor'); ?>
                                            <?php }?>
                                        </small>

                                    </div>
                                    <div class="mb-3 form-items">
                                        <div>
                                                <label class="form-check-label question__label noLabel"> <b>Institution </b><span class="required" style="color:red;">*</span> </label>
                                                <input class="form-control mb-3 required" name="fellowship_name_of_institution" type="text" id="fellowship_name_of_institution" value="<?php echo set_value('fellowship_name_of_institution',$editdata['fellowship_name_of_institution']);?>">    
                                        </div>
                                        <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('fellowship_name_of_institution')) {?>
                                                <?= $error = $validation->getError('fellowship_name_of_institution'); ?>
                                            <?php }?>
                                        </small>
                                        
                                    </div>
                                    <div class="mb-3 form-items">
                                        <div>
                                                <label class="form-check-label question__label noLabel"> <b> Department </b><span class="required" style="color:red;">*</span> </label>
                                                <input class="form-control mb-3 required" name="fellowship_supervisor_department" type="text" id="fellowship_supervisor_department" value="<?php echo set_value('fellowship_supervisor_department',$editdata['fellowship_supervisor_department']);?>">    
                                        </div>
                                        <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('fellowship_supervisor_department')) {?>
                                                <?= $error = $validation->getError('fellowship_supervisor_department'); ?>
                                            <?php }?>
                                        </small>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if(!empty($user['fellowship_description_of_research'])): ?>               
                                    <div class="col-lg-12">
                                        <div class="mb-3 form-items">
                                                <label class="form-label " for=""><b>Description of research to be carried out if the <i>Sun Pharma Science Foundation Clinical Research Fellowship</i> is awarded (2 pages), comprising the following sections: (a) Introduction, (b) Objectives, (c) Brief description of pilot data, if available, (d) Methodology, (e) Anticipated outcomes, (f) Timelines </b></label> 
                                                <div>
                                                <a href="<?=base_url();?>/uploads/<?=date('Y');?>/CRF/<?=$user['user_id'];?>/<?=$user['fellowship_description_of_research'];?>" target="_blank">
                                                <button class="btn btn-primary btn-sm" type="button">
                                                    <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg>View</button>
                                                </a>
                                                </div>
                                        </div>
                                    </div>
                                <?php endif;?>
                                <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                    <label class="form-label " for=""><b>Description of research to be carried out if the <i>Sun Pharma Science Foundation Clinical Research Fellowship</i> is awarded (2 pages), comprising the following sections: (a) Introduction, (b) Objectives, (c) Brief description of pilot data, if available, (d) Methodology, (e) Anticipated outcomes, (f) Timelines </b><span class="required" style="color:red;">*</span></label> 
                                            <div>
                                                 <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" accept=".pdf" name="fellowship_description_of_research" type="file" id="fellowship_description_of_research" value="<?=$editdata['fellowship_description_of_research'];?>">  
                                                </label>
                                                <?php if(isset($editdata['fellowship_description_of_research_name']) && !empty($editdata['fellowship_description_of_research_name'])): ?>
                                                    <span id="fellowship_description_of_research_nm"><?=$editdata['fellowship_description_of_research_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="justification_letter_uploaded_file" id="justification_letter_uploaded_file" value="<?=(isset($editdata['justification_letter']) && !empty($editdata['justification_letter']))?$editdata['justification_letter']:'';?>" />
                                                
                                                <div class="">
                                                    <small> </small>
                                                </div>
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('fellowship_description_of_research')) {?>
                                                <?= $error = $validation->getError('fellowship_description_of_research'); ?>
                                            <?php }?>
                                            </small>
                                    </div>
                                </div>
                               <?php        endif;
                                        endif;
                                     endif;
                                     ?>
                                </div>
                            </div>
                        </div>
			<p><b>Note: A printed copy of application with all relevant documents to be sent to The Office of the Sun
Pharma Science Foundation New Delhi within 10 days of submission.</b></p>
                        <p class="text-danger">Consent from the Supervisor under whom the research will be carried out [as per details provided in (15)], including facilitation of research in the supervisor's institution. [If awarded, the applicant must produce an undertaking from the head of the institution in which the research will be carried out stating that the applicant will be allowed to carry out the proposed research in the institution under the administrative terms and conditions specified by the <i>Sun Pharma Science Foundation</i>.]</p>
                        <p class="text-danger">All relevant documents in support of the statements made in the application (e.g., Mark sheets, academic award certificates, publications, etc.)</p>
                     <?php 
                   
                          if(isset($user['is_submitted']) && ($user['is_submitted'] == 0) && (isset($userdata['nominationEndDays']) && ($userdata['nominationEndDays'] > 0))):   ?>           
                        <div id="q-box__buttons">
                            <button id="next-btn" class="btn btn-primary" type="reset">Reset</button>
                            <button id="submit-btn" class="btn btn-success ms-2" type="submit">Submit</button>
                        </div>
                        <?php else:?>
                            <div id="q-box__buttons">
                            
                              <a href="<?=base_url();?>/uploads/<?=date('Y');?>/CRF/<?=$editdata['id'];?>/<?=$user['firstname'].".pdf";?>" id="submit-btn" class="btn btn-success ms-2" >Print</a>
                        </div>  
                    <?php endif;?>
                </form>
            </div>
        </div>
    </div>
</div><!-- PRELOADER -->
<div id="preloader-wrapper">
    <div id="preloader"></div>
    <div class="preloader-section section-left"></div>
    <div class="preloader-section section-right"></div>
</div></section>