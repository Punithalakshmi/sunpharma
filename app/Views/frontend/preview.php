
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
            <input type="hidden" name="id" value="<?=(isset($editdata['id']) && !empty($editdata['id']))?$editdata['id']:"";?>" />
                    <div id="steps-container">
                        <div class="step">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                    <div class="form-check ps-0 q-box">
                                      <div class="q-box__question col me-2 d-flex">     
                                        <label class="form-check-label question__label noLabel">
                                            <div class="form-label mb-2"> Photograph of the Applicant </div>
                                                <img class="uploadPreview" src="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['nominator_photo'];?>" width="200"
                                                            height="200" />
                                                    </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Category of the Award</label>
                                        <div><?=$user['category_name'];?>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Name of the Applicant</label>
                                        <div><?=$user['firstname'].' '.$user['lastname'];?>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Date of Birth</label>
                                        <div><?=$user['dob'];?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> Citizenship </label>
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
                                        <label class="form-label " for="">Designation & Office Address</label>
                                        <div>
                                        <?=$user['address'];?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Residence Address with Tel/ Cell No.
                                            E-mail</label>
                                            <div>
                                            <?=$user['residence_address'];?>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Mobile No.</label>
                                        <div><?=$user['phone'];?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Email ID</label>
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
                                        <label class="form-label " for="">Name of the Nominator</label>
                                        <div><?=$user['nominator_name'];?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">
                                          Designation & Office Address of the Nominator
                                          </label>
                                            <div >
                                            <?=$user['nominator_address'];?>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Mobile No of the Nominator</label>
                                        <div ><?=$user['nominator_phone'];?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Email ID of the Nominator</label>
                                        <div >
                                           <?=$user['nominator_email'];?>
                                        </div>
                                    </div>
                                </div>
                                <?php if(isset($user) && ($user['nomination_type'] == 'spsfn')): ?>
                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Whether the applicant has completed a Research Project</label>
                                        <div >
                                           <?=$user['is_completed_a_research_project'];?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Ongoing Course</label>
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
                                        <label class="form-label " for=""> Justification for Sponsoring the
                                            Nomination duly signed by the Nominator (not to exceed 400 words) </label>
                                            <div >
                                                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['justification_letter_filename'];?>" target="_blank">
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
                                        <label class="form-label " for=""> Passport </label>
                                            <div>
                                                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['passport_filename'];?>" target="_blank" >
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
                                        <label class="form-label " for="">  Letter from the supervisor certifying that the research work submitted for Sun Pharma Science Scholar Award has actually been done by the applicant </label>
                                            <div >
                                                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['supervisor_certifying'];?>" target="_blank">
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
                                  if(isset($user['justification_letter']) && !empty($user['justification_letter'])):
                                ?>
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> Justification for Sponsoring the Nomination duly signed by the Nominator/Supervisor  </label>
                                            <div>
                                                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['justification_letter'];?>" target="_blank" >
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
                                        <label class="form-label " for=""> Complete Bio-data of the Applicant
                                            (Max 1.5 MB) </label>
                                            <?php if(!empty($user['complete_bio_data'])): ?>
                                            <div>
                                              <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['complete_bio_data'];?>" target="_blank">
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
                                        <label class="form-label " for=""> In order of Importance, list of 10
                                            best papers of the applicant highlighting the important
                                            discoveries/contributions described in them briefly (Max. 1 MB) </label>
                                            <?php if(!empty($user['best_papers'])): ?>
                                            <div>
                                            <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['best_papers'];?>" target="_blank">
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
                                        <!-- <label class="form-label " for=""> In order of Importance, list of 10
                                            best papers of the applicant highlighting the important
                                            discoveries/contributions described in them briefly (Max. 1 MB) </label> -->
                                            <div>
                                            <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" accept=".pdf" name="best_papers" type="file" id="best_papers" value="<?=$editdata['best_papers'];?>">  
                                                    
                                                </label>
                                                <div class="">
                                                    <small>Upload the List of Publication (Not more than 1 MB) </small>
                                                </div>
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
                                        <label class="form-label " for=""> Statement of Research Achievements, if
                                            any, on which any Award has already been Received by the Applicant. Please
                                            also upload brief citations on the research works for which the applicant
                                            has already received the awards (Max. 1 MB) </label>
                                            <?php if(!empty($user['statement_of_research_achievements'])): ?>
                                            <div >
                                            <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['statement_of_research_achievements'];?>" target="_blank">
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
                                        <label class="form-label " for=""> Signed details of the excellence in
                                            research work for which the Sun Pharma Research Award is claimed, including
                                            references & illustra- tions (Max. 2.5 MB). The candidate should duly sign
                                            on the details </label>
                                            <?php if(!empty($user['signed_details'])): ?>
                                            <div>
                                            <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['signed_details'];?>" target="_blank">
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
                                        <!-- <label class="form-label " for=""> Signed details of the excellence in
                                            research work for which the Sun Pharma Research Award is claimed, including
                                            references & illustra- tions (Max. 2.5 MB). The candidate should duly sign
                                            on the details </label> -->
                                            <div>
                                            <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" accept=".pdf" name="signed_details" type="file" id="signed_details" value="<?=$editdata['signed_details'];?>">    
                                                    
                                                </label>
                                                <div class="">
                                                    <small>Upload the details of the research work for which nomination
                                                        is being sent(Not more than 2.5 MB)</small>
                                                </div>
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
                                        <label class="form-label " for=""> Two specific publications/research
                                            papers of the applicant relevant to the research work mentioned above (Max.
                                            2.5 MB) </label>
                                            <?php if(!empty($user['specific_publications'])): ?>
                                            <div>
                                            <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['specific_publications'];?>" target="_blank">
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
                                        <label class="form-label " for=""> A signed statement by the applicant
                                            that the research work under reference has not been given any award. The
                                            applicant should also indicate the extent of the contribution of others
                                            associated with the research and he/she should clearly acknowledge his/her
                                            achievements. (Max. 500 KB) </label>
                                            <?php if(!empty($user['signed_statement'])): ?>
                                            <div>
                                            <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['signed_statement'];?>" target="_blank">
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
                                        <!-- <label class="form-label " for=""> A signed statement by the applicant
                                            that the research work under reference has not been given any award. The
                                            applicant should also indicate the extent of the contribution of others
                                            associated with the research and he/she should clearly acknowledge his/her
                                            achievements. (Max. 500 KB) </label> -->
                                            <div>
                                            <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" accept=".pdf" name="signed_statement" type="file" id="signed_statement" value="<?=$editdata['signed_statement'];?>">   
                                                    <br />
                                                   
                                                </label>
                                                <div class="">
                                                    <small>Upload the signed statement (Not more than 500 KB) </small>
                                                </div>
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
                                         <label class="form-label " for=""> Citation on the Research Work of the
                                            Applicant duly signed by the Nominator (Max. 300 KB) </label> 
                                            <?php if(!empty($user['citation'])): ?>
                                            <div>
                                            <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['citation'];?>" target="_blank">
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
                                        <label class="form-label " for=""> Details of the excellence in research work for which the Sun Pharma Science Scholar Award is claimed, including references and illustrations with following headings- Title, Introduction, Objectives, Materials and Methods, Results, Statistical Analysis, Discussion, Impact of the research in the advancement of knowledge or benefit to mankind, Literature reference. The candidate should duly sign on the details.(Max 2 MB)</label> 
                                        <?php if(!empty($user['excellence_research_work'])): ?>
                                            <div>
                                            <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['excellence_research_work'];?>" target="_blank">
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
                                        <label class="form-label " for=""> List of Publications, if any. If yes, Upload copies of any two publications (Max: 2 MB) </label>
                                        <?php if(!empty($user['lists_of_publications'])): ?>
                                            <div >
                                            <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['lists_of_publications'];?>" target="_blank">
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
                                        <label class="form-label " for=""> Statement of Merits/Awards/Scholarships already received by the Applicant (Max: 1 MB) </label>
                                        <?php if(!empty($user['statement_of_applicant'])): ?>
                                            <div>
                                            <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['statement_of_applicant'];?>" target="_blank">
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
                                        <label class="form-label " for=""> A letter stating that the project submitted for the award has received “ethical clearance” (Max: 250KB) </label>
                                        <?php if(!empty($user['ethical_clearance'])): ?>
                                            <div>
                                            <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['ethical_clearance'];?>" target="_blank">
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
                                        <label class="form-label " for=""> A statement duly signed by the nominee and the supervisor/co-author that academically or financially the thesis submitted for Sun Pharma Science Scholar Award-2021 has “non-conflict of interest” with the supervisor or co-authors (Max: 250KB) </label>
                                        <?php if(!empty($user['statement_of_duly_signed_by_nominee'])): ?>
                                            <div>
                                            <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['statement_of_duly_signed_by_nominee'];?>" target="_blank">
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
                                        <!-- <label class="form-label " for=""> A statement duly signed by the nominee and the supervisor/co-author that academically or financially the thesis submitted for Sun Pharma Science Scholar Award-2021 has “non-conflict of interest” with the supervisor or co-authors (Max: 250KB) </label> -->
                                            <div>
                                            <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" accept=".pdf" name="statement_of_duly_signed_by_nominee" type="file" id="statement_of_duly_signed_by_nominee" value="<?=$editdata['statement_of_duly_signed_by_nominee'];?>">   
                                                    <br />
                                                   
                                                </label>
                                                
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
                                        <label class="form-label " for=""> Citation (brief summary) on the Research Work of the Applicant duly signed by the Nominator (Max: 300 KB) </label>
                                        <?php if(!empty($user['citation'])): ?>
                                            <div>
                                            <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['citation'];?>" target="_blank">
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
                                        <label class="form-label " for=""> Aggregate marks obtained in PCB/PCM in Class XII or any other course (Max: 250 KB) </label>
                                        <?php if(!empty($user['aggregate_marks'])): ?>
                                            <div>
                                            <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['aggregate_marks'];?>" target="_blank">
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
                                        <label class="form-label " for=""> Year of Passing </label>
                                            <div>
                                              <?=$user['year_of_passing'];?>
                                            </div>
                                    </div>
                                    <?php if($user['is_submitted'] == 0): ?> 
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <!-- <label class="form-label " for=""> Year of Passing </label> -->
                                            <div>
                                                  <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" name="year_of_passing" type="text" id="year_of_passing" value="<?=$editdata['year_of_passing'];?>">   
                                                    <br>
                                                </label>
                                                
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
                                        <label class="form-label " for=""> Number of Attempts </label>
                                            <div>
                                              <?=$user['number_of_attempts'];?>
                                            </div>
                                    </div>
                                    <?php if($user['is_submitted'] == 0): ?>
                                  <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <!-- <label class="form-label " for=""> Number of Attempts </label> -->
                                                <div>
                                                  <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" name="number_of_attempts" type="text" id="number_of_attempts" value="<?=$editdata['number_of_attempts'];?>">   
                                                    <br>
                                                </label>
                                                
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
                                        <label class="form-label " for=""> Age proof (Max: 250KB) </label>
                                        <?php if(!empty($user['age_proof'])): ?>
                                            <div>
                                            <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['age_proof'];?>" target="_blank">
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
                                        <label class="form-label " for=""> A voluntary declaration from the candidate that they would work in the public or private funded academic/research based organizations for a minimum period of two years after completion of his/her studies. (Max: 250KB) </label>
                                        <?php if(!empty($user['declaration_candidate'])): ?>
                                            <div>
                                            <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['declaration_candidate'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View Declaration
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
                            
                            <a  href="<?=base_url();?>/print/<?=$editdata['id'];?>" id="submit-btn" class="btn btn-success ms-2" >Print</a>
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