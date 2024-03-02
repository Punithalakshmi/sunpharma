
<section class="bg-primary-gradient"><!-- CONTAINER -->
    <div id="mainform-container" class="container py-1 preview">
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
                   if(isset($user['nomination_type']) && ($user['nomination_type'] == 'spsfn')) {
                     $type = 'Science Scholar'; 
                   } 
                  else
                  {
                     $type = 'Research';
                  }
                  
                 ?>
               <?php if(isset($userdata['nominationEndDays']) && $userdata['nominationEndDays'] > 0): ?>
                 Sun Pharma Science Foundation <?=$type;?> Awards <?=date('Y');?>
                <br>Online Submission Of Nominations
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
            <form method="post" name="nomination_data" action="<?=base_url();?>/view" enctype="multipart/form-data">
            <?= csrf_field(); ?>   
            <?php 

                $typeOfAward = '';
                switch ($user['nomination_type']) {
                    case 'ssan':
                        $typeOfAward = 'RA';
                        break;
                    case 'spsfn':
                        $typeOfAward = 'SSA';
                        break;
                    
                }

                $currentYear = date('Y');

                $fileUploadDir = base_url().'/uploads/'.$currentYear.'/'.$typeOfAward.'/'.$user['user_id'];

            ?>
            <input type="hidden" name="id" value="<?=(isset($editdata['id']) && !empty($editdata['id']))?$editdata['id']:"";?>" />
                    <div id="steps-container">
                        <div class="step">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                    <div class="form-check ps-0 q-box">
                                      <div class="q-box__question col me-2 d-flex">     
                                        <label class="form-check-label question__label noLabel">
                                            <div class="form-label mb-2"> <b>Photograph of the Applicant </b></div>
                                                <img class="uploadPreview" src="<?= $fileUploadDir;?>/<?=$user['nominator_photo'];?>" width="200"
                                                            height="200" />
                                                    </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""><b>Category of the Award</b></label>
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
                                        <label class="form-label " for=""><b> Citizenship </b> </label>
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
                                        <label class="form-label " for=""><b>Residence Address with Tel/ Cell No.
                                            E-mail</b></label>
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
                                          <b>Designation & Office Address of the Nominator</b>
                                          </label>
                                            <div >
                                            <?=$user['nominator_address'];?>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""><b>Mobile No of the Nominator</b></label>
                                        <div ><?=$user['nominator_phone'];?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""><b>Email ID of the Nominator</b></label>
                                        <div >
                                           <?=$user['nominator_email'];?>
                                        </div>
                                    </div>
                                </div>
                                <?php if(isset($user) && ($user['nomination_type'] == 'spsfn')): ?>
                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""><b>Whether the applicant has completed a Research Project</b></label>
                                        <div >
                                           <?=$user['is_completed_a_research_project'];?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""><b>Ongoing Course</b></label>
                                        <div >
                                           <?=$user['ongoing_course'];?>
                                        </div>
                                    </div>
                                </div>
                              <?php endif;?>
                                <?php 
                                
                                
                                if(isset($user) && ($user['nomination_type'] == 'ssan')):
                                  if(isset($user['justification_letter_filename']) && !empty($user['justification_letter_filename'])): ?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> <b>Justification for Sponsoring the
                                            Nomination duly signed by the Nominator (not to exceed 400 words) </b> </label>
                                            <div >
                                                <a href="<?=$fileUploadDir;?>/<?=$user['justification_letter_filename'];?>" target="_blank">
                                                  <button class="btn btn-primary btn-sm" type="button">
                                                    <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                    </svg> View
                                                  </button>
                                               </a>
                                            </div>
                                    </div>
                                </div>
                                <?php endif;
                                  if(isset($user['passport_filename']) && !empty($user['passport_filename'])):
                                ?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> <b>Passport </b> </label>
                                            <div>
                                                <a href="<?=$fileUploadDir;?>/<?=$user['passport_filename'];?>" target="_blank" >
                                                  <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                    </svg> View
                                                  </button>
                                               </a>
                                            </div>
                                    </div>
                                </div>
                              <?php endif; 
                               else:
                              
                                if(isset($user['supervisor_certifying']) && !empty($user['supervisor_certifying'])): ?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> <b> Letter from the supervisor certifying that the research work submitted for Sun Pharma Science Scholar Award has actually been done by the applicant </b> </label>
                                            <div >
                                                <a href="<?=$fileUploadDir;?>/<?=$user['supervisor_certifying'];?>" target="_blank">
                                                  <button class="btn btn-primary btn-sm" type="button">
                                                    <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                    </svg> View
                                                  </button>
                                               </a>
                                            </div>
                                    </div>
                                </div>
                                <?php endif;
                                  if(isset($user['justification_letter_filename']) && !empty($user['justification_letter_filename'])):
                                ?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> <b>Justification for Sponsoring the Nomination duly signed by the Nominator/Supervisor </b>  </label>
                                            <div>
                                                <a href="<?=$fileUploadDir;?>/<?=$user['justification_letter_filename'];?>" target="_blank" >
                                                  <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                    </svg> View
                                                  </button>
                                               </a>
                                            </div>
                                    </div>
                                </div>
                              <?php endif; 
                               endif;?>
                            </div>
                        </div>
                  
                        
                        <div class="step">

                            <div class="row">
                            <?php if($userdata['nominationEndDays'] > 0): ?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> <b>Complete Bio-data of the Applicant
                                            (Max 1.5 MB) </b><span class="required" style="color:red;">*</span></label>
                                            <?php if(!empty($user['complete_bio_data'])): ?>
                                            <div>
                                              <a href="<?=$fileUploadDir;?>/<?=$user['user_id'];?>/<?=$user['complete_bio_data'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                              </svg> View
                                            </button>
                                            </a>
                                            </div>
                                            <?php endif;?>
                                    </div>
                                </div>
                                <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <!-- <label class="form-label " for=""> Complete Bio-data of the Applicant
                                            (Max 1.5 MB) </label> -->
                                            <div>
                                                <input class="form-control mb-3 required" accept=".pdf" name="complete_bio_data" type="file" id="complete_bio_data" value="<?=$editdata['complete_bio_data'];?>">   
                                                <div class="">
                                                    <small>Upload the Bio-data (Not more than 1.5 MB)</small>
                                                </div>
                                            </div>
                                            <?php if(isset($editdata['complete_bio_data_name']) && !empty($editdata['complete_bio_data_name'])): ?>
                                                    <span id="complete_bio_data_name"><?=$editdata['complete_bio_data_name'];?></span>
                                            <?php endif;?>
                                            <input type="hidden" name="complete_bio_data_uploaded_file" id="complete_bio_data_uploaded_file" value="<?=(isset($editdata['complete_bio_data']) && !empty($editdata['complete_bio_data']))?$editdata['complete_bio_data']:'';?>" />
                                            
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('complete_bio_data')) {?>
                                                <?= $error = $validation->getError('complete_bio_data'); ?>
                                            <?php }?>
                                            </small>
                                    </div>
                                </div>
                                <?php  
                                    endif;
                                   if(isset($user) && ($user['nomination_type'] == 'ssan') ):
                                    
                                ?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label"> <b>In order of Importance, list of 10
                                            best papers of the applicant highlighting the important
                                            discoveries/contributions described in them briefly (Max. 1 MB)</b> <span class="required" style="color:red;">*</span> </label>
                                            <?php if(!empty($user['best_papers'])): ?>
                                            <div>
                                            <a href="<?=$fileUploadDir;?>/<?=$user['best_papers'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View</button>
                                              </a>
                                            </div>
                                            <?php endif;?>
                                    </div>
                                </div>
                                <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                       
                                            <div>
                                            <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" accept=".pdf" name="best_papers" type="file" id="best_papers" value="<?=$editdata['best_papers'];?>">  
                                                    
                                                </label>
                                                <div class="">
                                                    <small>Upload the List of Publication (Not more than 1 MB) </small>
                                                </div>
                                                <?php if(isset($editdata['best_papers_name']) && !empty($editdata['best_papers_name'])): ?>
                                                    <span id="best_papers_name"><?=$editdata['best_papers_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="best_papers_uploaded_file" id="best_papers_uploaded_file" value="<?=(isset($editdata['best_papers']) && !empty($editdata['best_papers']))?$editdata['best_papers']:'';?>" />
                                                
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('best_papers')) {?>
                                                <?= $error = $validation->getError('best_papers'); ?>
                                            <?php }?>
                                            </small>
                                    </div>
                                </div>
                               <?php endif;?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> <b>Statement of Research Achievements, if
                                            any, on which any Award has already been Received by the Applicant. Please
                                            also upload brief citations on the research works for which the applicant
                                            has already received the awards (Max. 1 MB) </b><span class="required" style="color:red;">*</span></label>
                                            <?php if(!empty($user['statement_of_research_achievements'])): ?>
                                            <div >
                                            <a href="<?=$fileUploadDir;?>/<?=$user['statement_of_research_achievements'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View</button>
</a>
                                            </div>
                                            <?php endif;?>
                                    </div>
                                </div>
                                <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <!-- <label class="form-label " for=""> Statement of Research Achievements, if
                                            any, on which any Award has already been Received by the Applicant. Please
                                            also upload brief citations on the research works for which the applicant
                                            has already received the awards (Max. 1 MB) </label> -->
                                            <div>
                                            <label class="form-check-label question__label noLabel">
                                                  <input class="form-control mb-3 required" accept=".pdf" name="statement_of_research_achievements" type="file" id="statement_of_research_achievements" value="<?=$editdata['statement_of_research_achievements'];?>"> 
                                                 
                                                </label>
                                                <div class="">
                                                    <small>Upload the list of awards already received by the applicant
                                                        (Not more than 1MB)
                                                    </small>
                                                </div>
                                                <?php if(isset($editdata['statement_of_research_achievements_name']) && !empty($editdata['statement_of_research_achievements_name'])): ?>
                                                    <span id="statement_of_research_achievements_name"><?=$editdata['statement_of_research_achievements_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="statement_of_research_achievements_uploaded_file" id="statement_of_research_achievements_uploaded_file" value="<?=(isset($editdata['statement_of_research_achievements']) && !empty($editdata['statement_of_research_achievements']))?$editdata['statement_of_research_achievements']:'';?>" />
                                                
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('statement_of_research_achievements')) {?>
                                                <?= $error = $validation->getError('statement_of_research_achievements'); ?>
                                            <?php }?>
                                            </small>
                                    </div>
                                </div>
                                <?php endif;?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> <b>Signed details of the excellence in
                                            research work for which the Sun Pharma Research Award is claimed, including
                                            references & illustra- tions (Max. 2.5 MB). The candidate should duly sign
                                            on the details </b><span class="required" style="color:red;">*</span></label>
                                            <?php if(!empty($user['signed_details'])): ?>
                                            <div>
                                            <a href="<?=$fileUploadDir;?>/<?=$user['signed_details'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View</button>
</a>
                                            </div>
                                            <?php endif;?>
                                    </div>
                                </div>
                                <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                       
                                            <div>
                                            <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" accept=".pdf" name="signed_details" type="file" id="signed_details" value="<?=$editdata['signed_details'];?>">    
                                                    
                                                </label>
                                                <div class="">
                                                    <small>Upload the details of the research work for which nomination
                                                        is being sent(Not more than 2.5 MB)</small>
                                                </div>
                                                <?php if(isset($editdata['signed_details_name']) && !empty($editdata['signed_details_name'])): ?>
                                                    <span id="signed_details_name"><?=$editdata['signed_details_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="signed_details_uploaded_file" id="signed_details_uploaded_file" value="<?=(isset($editdata['signed_details']) && !empty($editdata['signed_details']))?$editdata['signed_details']:'';?>" />
                                                
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('signed_details')) {?>
                                                <?= $error = $validation->getError('signed_details'); ?>
                                            <?php }?>
                                            </small>
                                    </div>
                                </div>
                               <?php endif;?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> <b>Two specific publications/research
                                            papers of the applicant relevant to the research work mentioned above (Max.
                                            2.5 MB)</b> <span class="required" style="color:red;">*</span></label>
                                            <?php if(!empty($user['specific_publications'])): ?>
                                            <div>
                                            <a href="<?=$fileUploadDir;?>/<?=$user['specific_publications'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View</button>
</a>
                                            </div>
                                            <?php endif;?>
                                    </div>
                                </div>
                                <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <!-- <label class="form-label " for=""> Two specific publications/research
                                            papers of the applicant relevant to the research work mentioned above (Max.
                                            2.5 MB) </label> -->
                                            <div>
                                                <label class="form-check-label question__label noLabel">
                                                  <input class="form-control mb-3 required" accept=".pdf" name="specific_publications" type="file" id="specific_publications" value="<?=$editdata['specific_publications'];?>">  
                                                </label>
                                                <div class="">
                                                    <small>Upload the publication/Research paper (Not more than 2.5 MB)</small>
                                                </div>
                                                <?php if(isset($editdata['specific_publications_name']) && !empty($editdata['specific_publications_name'])): ?>
                                                    <span id="specific_publications_name"><?=$editdata['specific_publications_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="specific_publications_uploaded_file" id="specific_publications_uploaded_file" value="<?=(isset($editdata['specific_publications']) && !empty($editdata['specific_publications']))?$editdata['specific_publications']:'';?>" />
                                                
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('specific_publications')) {?>
                                                <?= $error = $validation->getError('specific_publications'); ?>
                                            <?php }?>
                                            </small>
                                    </div>
                                </div>
                               <?php endif;?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""><b> A signed statement by the applicant
                                            that the research work under reference has not been given any award. The
                                            applicant should also indicate the extent of the contribution of others
                                            associated with the research and he/she should clearly acknowledge his/her
                                            achievements. (Max. 500 KB)</b> <span class="required" style="color:red;">*</span></label>
                                            <?php if(!empty($user['signed_statement'])): ?>
                                            <div>
                                            <a href="<?=$fileUploadDir;?>/<?=$user['signed_statement'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View
                                             </button>
</a>
                                            </div>
                                            <?php endif;?>
                                    </div>
                                </div>
                                <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                       
                                            <div>
                                            <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" accept=".pdf" name="signed_statement" type="file" id="signed_statement" value="<?=$editdata['signed_statement'];?>">   
                                                    <br />
                                                   
                                                </label>
                                                <div class="">
                                                    <small>Upload the signed statement (Not more than 500 KB) </small>
                                                </div>
                                                <?php if(isset($editdata['signed_statement_name']) && !empty($editdata['signed_statement_name'])): ?>
                                                    <span id="signed_statement_name"><?=$editdata['signed_statement_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="signed_statement_uploaded_file" id="signed_statement_uploaded_file" value="<?=(isset($editdata['signed_statement']) && !empty($editdata['signed_statement']))?$editdata['signed_statement']:'';?>" />
                                                
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('signed_statement')) {?>
                                                <?= $error = $validation->getError('signed_statement'); ?>
                                            <?php }?>
                                            </small>
                                    </div>
                                </div>
                                <?php endif;?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                         <label class="form-label " for=""> <b>Citation on the Research Work of the
                                            Applicant duly signed by the Nominator (Max. 300 KB) </b><span class="required" style="color:red;">*</span></label> 
                                            <?php if(!empty($user['citation'])): ?>
                                            <div>
                                            <a href="<?=$fileUploadDir;?>/<?=$user['citation'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View
                                          </button>
</a>
                                            </div>
                                            <?php endif;?>
                                    </div>
                                    <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <!-- <label class="form-label " for=""> Citation on the Research Work of the
                                            Applicant duly signed by the Nominator (Max. 300 KB) </label> -->
                                            <div>
                                                  <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" accept=".pdf" name="citation" type="file" id="citation" value="<?=$editdata['citation'];?>">   
                                                    <br>
                                                    
                                                </label>
                                                <div class="">
                                                    <small>Upload the Citation (Not more than 300KB) </small>
                                                </div>
                                                <?php if(isset($editdata['citation_name']) && !empty($editdata['citation_name'])): ?>
                                                    <span id="citation_name"><?=$editdata['citation_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="citation_uploaded_file" id="citation_uploaded_file" value="<?=(isset($editdata['citation']) && !empty($editdata['citation']))?$editdata['citation']:'';?>" />
                                                
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('citation')) {?>
                                                <?= $error = $validation->getError('citation'); ?>
                                            <?php }?>
                                            </small>
                                        </div>
                                    </div>
                                    <?php
                                       endif;
                                       else: 

                                        ?>
                             
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> <b>Details of the excellence in research work for which the Sun Pharma Science Scholar Award is claimed, including references and illustrations with following headings- Title, Introduction, Objectives, Materials and Methods, Results, Statistical Analysis, Discussion, Impact of the research in the advancement of knowledge or benefit to mankind, Literature reference. The candidate should duly sign on the details(Max 2 MB) </b><span class="required" style="color:red;">*</span></label> 
                                        <?php if(!empty($user['excellence_research_work'])): ?>
                                            <div>
                                            <a href="<?=$fileUploadDir;?>/<?=$user['excellence_research_work'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button">
                                                <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg>View</button>
                                              </a>
                                            </div>
                                            <?php endif;?>
                                    </div>
                                </div>
                                <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <!-- <label class="form-label " for=""> Details of the excellence in research work for which the Sun Pharma Science Scholar Award is claimed, including references and illustrations with following headings- Title, Introduction, Objectives, Materials and Methods, Results, Statistical Analysis, Discussion, Impact of the research in the advancement of knowledge or benefit to mankind, Literature reference. The candidate should duly sign on the details.(Max 2 MB)</label> -->
                                            <div>
                                            <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" accept=".pdf" name="excellence_research_work" type="file" id="excellence_research_work" value="<?=$editdata['excellence_research_work'];?>">  
                                                    
                                                </label>
                                                <div class="">
                                                    <small> </small>
                                                </div>
                                                <?php if(isset($editdata['excellence_research_work_name']) && !empty($editdata['excellence_research_work_name'])): ?>
                                                    <span id="excellence_research_work_name"><?=$editdata['excellence_research_work_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="excellence_research_work_uploaded_file" id="excellence_research_work_uploaded_file" value="<?=(isset($editdata['excellence_research_work']) && !empty($editdata['excellence_research_work']))?$editdata['excellence_research_work']:'';?>" />
                                                
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('excellence_research_work')) {?>
                                                <?= $error = $validation->getError('excellence_research_work'); ?>
                                            <?php }?>
                                            </small>
                                    </div>
                                </div>
                               <?php endif;?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""><b> List of Publications, if any. If yes, Upload copies of any two publications (Max: 2 MB) </b> <span class="required" style="color:red;">*</span></label>
                                        <?php if(!empty($user['lists_of_publications'])): ?>
                                            <div >
                                            <a href="<?=$fileUploadDir;?>/<?=$user['lists_of_publications'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View</button>
</a>
                                            </div>
                                            <?php endif;?>
                                    </div>
                                </div>
                                <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <!-- <label class="form-label " for=""> List of Publications, if any. If yes, Upload copies of any two publications (Max: 2 MB) </label> -->
                                            <div>
                                            <label class="form-check-label question__label noLabel">
                                                  <input class="form-control mb-3 required" accept=".pdf" name="lists_of_publications" type="file" id="lists_of_publications" value="<?=$editdata['lists_of_publications'];?>"> 
                                                 
                                                </label>
                                                <div class="">
                                                    <small>Upload 
                                                        (Not more than 2MB)
                                                    </small>
                                                </div>
                                                <?php if(isset($editdata['lists_of_publications_name']) && !empty($editdata['lists_of_publications_name'])): ?>
                                                    <span id="lists_of_publications_name"><?=$editdata['lists_of_publications_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="lists_of_publications_uploaded_file" id="lists_of_publications_uploaded_file" value="<?=(isset($editdata['lists_of_publications']) && !empty($editdata['lists_of_publications']))?$editdata['lists_of_publications']:'';?>" />
                                                
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('lists_of_publications')) {?>
                                                <?= $error = $validation->getError('lists_of_publications'); ?>
                                            <?php }?>
                                            </small>
                                    </div>
                                </div>
                              <?php endif;?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> <b>Statement of Merits/Awards/Scholarships already received by the Applicant </b> <span class="required" style="color:red;">*</span></label>
                                        <?php if(!empty($user['statement_of_applicant'])): ?>
                                            <div>
                                            <a href="<?=$fileUploadDir;?>/<?=$user['statement_of_applicant'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View</button>
</a>
                                            </div>
                                            <?php endif;?>
                                    </div>
                                </div>
                                <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <!-- <label class="form-label " for=""> Statement of Merits/Awards/Scholarships already received by the Applicant (Max: 1 MB) </label> -->
                                            <div>
                                            <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" accept=".pdf" name="statement_of_applicant" type="file" id="statement_of_applicant" value="<?=$editdata['statement_of_applicant'];?>">    
                                                    
                                                </label>
                                                <div class="">
                                                    <small>Upload (Not more than 1 MB)</small>
                                                </div>
                                                <?php if(isset($editdata['statement_of_applicant_name']) && !empty($editdata['statement_of_applicant_name'])): ?>
                                                    <span id="statement_of_applicant_name"><?=$editdata['statement_of_applicant_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="statement_of_applicant_uploaded_file" id="statement_of_applicant_uploaded_file" value="<?=(isset($editdata['statement_of_applicant']) && !empty($editdata['statement_of_applicant']))?$editdata['statement_of_applicant']:'';?>" />
                                                
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('statement_of_applicant')) {?>
                                                <?= $error = $validation->getError('statement_of_applicant'); ?>
                                            <?php }?>
                                            </small>
                                    </div>
                                </div>
                               <?php endif;?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> <b>A letter stating that the project submitted for the award has received “ethical clearance”  (Max: 250KB) </b><span class="required" style="color:red;">*</span></label>
                                        <?php if(!empty($user['ethical_clearance'])): ?>
                                            <div>
                                            <a href="<?=$fileUploadDir;?>/<?=$user['ethical_clearance'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View</button>
</a>
                                            </div>
                                            <?php endif;?>
                                    </div>
                                </div>
                                <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <!-- <label class="form-label " for=""> A letter stating that the project submitted for the award has received “ethical clearance” (Max: 250KB) </label> -->
                                            <div>
                                                <label class="form-check-label question__label noLabel">
                                                  <input class="form-control mb-3 required" accept=".pdf" name="ethical_clearance" type="file" id="ethical_clearance" value="<?=$editdata['ethical_clearance'];?>">  
                                                </label>
                                                <?php if(isset($editdata['ethical_clearance_name']) && !empty($editdata['ethical_clearance_name'])): ?>
                                                    <span id="ethical_clearance_name"><?=$editdata['ethical_clearance_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="ethical_clearance_uploaded_file" id="ethical_clearance_uploaded_file" value="<?=(isset($editdata['ethical_clearance']) && !empty($editdata['ethical_clearance']))?$editdata['ethical_clearance']:'';?>" />
                                                
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('ethical_clearance')) {?>
                                                <?= $error = $validation->getError('ethical_clearance'); ?>
                                            <?php }?>
                                            </small>
                                    </div>
                                </div>
                               <?php endif;?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> <b>A statement duly signed by the nominee and the supervisor/co-author that academically or financially the thesis submitted for Sun Pharma Science Scholar Award-<?=date("Y")?> has “non-conflict of interest” with the supervisor or co-authors (Max: 250KB) </b> <span class="required" style="color:red;">*</span></label>
                                        <?php if(!empty($user['statement_of_duly_signed_by_nominee'])): ?>
                                            <div>
                                            <a href="<?=$fileUploadDir;?>/<?=$user['statement_of_duly_signed_by_nominee'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View
                                             </button>
</a>
                                            </div>
                                            <?php endif; ?>
                                    </div>
                                </div>
                                <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                      
                                            <div>
                                            <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" accept=".pdf" name="statement_of_duly_signed_by_nominee" type="file" id="statement_of_duly_signed_by_nominee" value="<?=$editdata['statement_of_duly_signed_by_nominee'];?>">   
                                                    <br />
                                                   
                                                </label>
                                                <?php if(isset($editdata['statement_of_duly_signed_by_nominee_name']) && !empty($editdata['statement_of_duly_signed_by_nominee_name'])): ?>
                                                    <span id="statement_of_duly_signed_by_nominee_name"><?=$editdata['statement_of_duly_signed_by_nominee_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="statement_of_duly_signed_by_nominee_uploaded_file" id="statement_of_duly_signed_by_nominee_uploaded_file" value="<?=(isset($editdata['statement_of_duly_signed_by_nominee']) && !empty($editdata['statement_of_duly_signed_by_nominee']))?$editdata['statement_of_duly_signed_by_nominee']:'';?>" />
                                                
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('statement_of_duly_signed_by_nominee')) {?>
                                                <?= $error = $validation->getError('statement_of_duly_signed_by_nominee'); ?>
                                            <?php }?>
                                            </small>
                                    </div>
                                </div>
                                <?php endif;?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> <b>Citation (brief summary) on the Research Work of the Applicant duly signed by the Nominator  (Max: 300 KB) </b><span class="required" style="color:red;">*</span></label>
                                        <?php if(!empty($user['citation'])): ?>
                                            <div>
                                            <a href="<?=$fileUploadDir;?>/<?=$user['citation'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View
                                          </button>
</a>
                                            </div>
                                            <?php endif;?>
                                    </div>
                                    <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <!-- <label class="form-label " for=""> Citation (brief summary) on the Research Work of the Applicant duly signed by the Nominator (Max: 300 KB) </label> -->
                                            <div>
                                                  <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" accept=".pdf" name="citation" type="file" id="citation" value="<?=$editdata['citation'];?>">   
                                                    <br>
                                                    
                                                </label>
                                                <?php if(isset($editdata['citation_name']) && !empty($editdata['citation_name'])): ?>
                                                    <span id="citation_name"><?=$editdata['citation_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="citation_uploaded_file" id="citation_uploaded_file" value="<?=(isset($editdata['citation']) && !empty($editdata['citation']))?$editdata['citation']:'';?>" />
                                                
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('citation')) {?>
                                                <?= $error = $validation->getError('citation'); ?>
                                            <?php }?>
                                            </small>
                                        </div>
                                    </div>
                                  <?php endif;?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> <b>Aggregate marks obtained in PCB/PCM in Class XII or any other course (Max: 250 KB) </b><span class="required" style="color:red;">*</span></label>
                                        <?php if(!empty($user['aggregate_marks'])): ?>
                                            <div>
                                            <a href="<?=$fileUploadDir;?>/<?=$user['aggregate_marks'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View
                                          </button>
                                          </a>
                                            </div>
                                            <?php endif;?>
                                    </div>
                                    <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <!-- <label class="form-label " for=""> Aggregate marks obtained in PCB/PCM in Class XII or any other course (Max: 250 KB) </label> -->
                                            <div>
                                                  <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" accept=".pdf" name="aggregate_marks" type="file" id="aggregate_marks" value="<?=$editdata['aggregate_marks'];?>">   
                                                    <br>
                                                </label>
                                                <?php if(isset($editdata['aggregate_marks_name']) && !empty($editdata['aggregate_marks_name'])): ?>
                                                    <span id="aggregate_marks_name"><?=$editdata['aggregate_marks_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="aggregate_marks_uploaded_file" id="aggregate_marks_uploaded_file" value="<?=(isset($editdata['aggregate_marks']) && !empty($editdata['aggregate_marks']))?$editdata['aggregate_marks']:'';?>" />
                                                
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('aggregate_marks')) {?>
                                                <?= $error = $validation->getError('aggregate_marks'); ?>
                                            <?php }?>
                                            </small>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                   <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""><b> Year of Passing </b><span class="required" style="color:red;">*</span></label>
                                            <div>
                                              <?=(isset($user['year_of_passing']) && !empty($user['year_of_passing']))?$user['year_of_passing']:'';?>
                                            </div>
                                    </div>
                                    <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <!-- <label class="form-label " for=""> Year of Passing </label> -->
                                            <div>
                                                 <input class="form-control mb-3 required" name="year_of_passing" type="text" id="year_of_passing" value="<?=$editdata['year_of_passing'];?>">   
                                                    
                                            </div>

                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('year_of_passing')) {?>
                                                <?= $error = $validation->getError('year_of_passing'); ?>
                                            <?php }?>
                                            </small>
                                        </div>
                                    </div>
                                   <?php endif;?>
                                   <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""><b> Number of Attempts </b><span class="required" style="color:red;">*</span></label>
                                            <div>
                                              <?=(isset($user['number_of_attempts']) && !empty($user['number_of_attempts']))?$user['number_of_attempts']:'';?>
                                            </div>
                                    </div>
                                    <?php if($user['is_submitted'] == 0): ?>
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <!-- <label class="form-label " for=""> Number of Attempts </label> -->
                                                <div>
                                                    <input class="form-control mb-3 required" name="number_of_attempts" type="text" id="number_of_attempts" value="<?=$editdata['number_of_attempts'];?>">   
                                                </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('number_of_attempts')) {?>
                                                <?= $error = $validation->getError('number_of_attempts'); ?>
                                            <?php }?>
                                            </small>
                                        </div>
                                    </div>
                                   <?php endif;?>
                                   <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> <b>Age proof (Max: 250KB)</b> <span class="required" style="color:red;">*</span></label>
                                        <?php if(!empty($user['age_proof'])): ?>
                                            <div>
                                            <a href="<?=$fileUploadDir;?>/<?=$user['age_proof'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View Age Proof
                                          </button>
                                          </a>
                                            </div>
                                            <?php endif;?>
                                    </div>
                                    <?php if($user['is_submitted'] == 0): ?>
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <!-- <label class="form-label " for=""> Age proof (Max: 250KB)</label> -->
                                            <div>
                                                  <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" accept=".pdf" name="age_proof" type="file" id="age_proof" value="<?=$editdata['age_proof'];?>">   
                                                    <br>
                                                </label>
                                                 <?php if(isset($editdata['age_proof_name']) && !empty($editdata['age_proof_name'])): ?>
                                                    <span id="age_proof_name"><?=$editdata['age_proof_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="age_proof_uploaded_file" id="age_proof_uploaded_file" value="<?=(isset($editdata['age_proof']) && !empty($editdata['age_proof']))?$editdata['age_proof']:'';?>" />
                                                
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('age_proof')) {?>
                                                <?= $error = $validation->getError('age_proof'); ?>
                                            <?php }?>
                                            </small>
                                        </div>
                                    </div>
                                   <?php endif;?>
                                   <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""><b> A voluntary declaration from the candidate that they would work in the public or private funded academic/research based organizations for a minimum period of two years after completion of his/her studies.  </b> <span class="required" style="color:red;">*</span></label>
                                        <?php if(!empty($user['declaration_candidate'])): ?>
                                            <div>
                                            <a href="<?=$fileUploadDir;?>/<?=$user['declaration_candidate'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg>View
                                          </button>
                                          </a>
                                        </div>
                                    <?php endif;?>
                                    </div>
                                   <?php if($user['is_submitted'] == 0): ?>
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <!-- <label class="form-label " for=""> A voluntary declaration from the candidate that they would work in the public or private funded academic/research based organizations for a minimum period of two years after completion of his/her studies. (Max: 250KB) </label> -->
                                            <div>
                                                  <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" accept=".pdf" name="declaration_candidate" type="file" id="declaration_candidate" value="<?=$editdata['declaration_candidate'];?>">   
                                                    <br>
                                                </label>
                                                <?php if(isset($editdata['declaration_candidate_name']) && !empty($editdata['declaration_candidate_name'])): ?>
                                                    <span id="declaration_candidate_name"><?=$editdata['declaration_candidate_name'];?></span>
                                                <?php endif;?>
                                                <input type="hidden" name="declaration_candidate_uploaded_file" id="declaration_candidate_uploaded_file" value="<?=(isset($editdata['declaration_candidate']) && !empty($editdata['declaration_candidate']))?$editdata['declaration_candidate']:'';?>" />
                                                
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('declaration_candidate')) {?>
                                                <?= $error = $validation->getError('declaration_candidate'); ?>
                                            <?php }?>
                                            </small>
                                        </div>
                                    </div>
                                    <?php endif;
                                    endif;
                                         endif;
                                         ?>
                                </div>
                            </div>
                        </div>
                     <?php 
                   
                          if(isset($user['is_submitted']) && ($user['is_submitted'] == 0) && ($userdata['nominationEndDays'] > 0)):   ?>           
                        <div id="q-box__buttons">
                            <button id="next-btn" class="btn btn-primary" type="reset">Reset</button>
                            <button id="submit-btn" class="btn btn-success ms-2" type="submit">Submit</button>
                        </div>
                        <?php else:?>
                            <div id="q-box__buttons">
                            
                            <a  href="<?=$fileUploadDir;?>/<?=$user['firstname'].".pdf";?>" id="submit-btn" class="btn btn-success ms-2" >Print</a>
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