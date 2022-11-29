<section class="bg-primary-gradient"><!-- CONTAINER -->
     <div id="mainform-container" class=" container py-1">
    <div class="row mt-4 mx-auto" style="padding-bottom: 5px">
        <div class="col-lg-12">
            <h2 class="text-capitalize fw-normal text-start text-center" style="color: #2d2d2d;
            font-size: 1.6rem;
            font-weight: bold!important;">Sun Pharma Science Foundation Research Awards 2022
                <br>Online Submission Of Nominations
            </h2>
        </div>
    </div>

    
    <div class="row">
    <form name="research_awards" id="ssanNomination" method="POST" action="<?=base_url();?>/ssan" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?=(isset($editdata['id']))?$editdata['id']:"";?>" >
    <input type="hidden" name="detail_id" value="<?=(isset($editdata['detail_id']))?$editdata['detail_id']:"";?>" >
    <?php if(session()->getFlashdata('msg')):?>
        <div class="col-xl-3 col-lg-4" style="color:green;font-size:14px;">
            <?= session()->getFlashdata('msg') ?>
        </div>
    <?php endif;?>
        <!-- FORMS -->
        <div id="mainform-items" class="col-lg-12 mx-0 px-0">
            <div class="progress">
                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="50"
                    class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                    style="width: 0%; background-color:#f6911f; opacity: .5">
                </div>
            </div>
            <div id="qbox-container">
                    <div id="steps-container">
                        <section>
                         <div class="step" >
                         <h3>Step1</h3>
                            <div class="step-status step1"><span>Step 1</span> <span>Step 2</span> <span>Step 3</span>
                                <span>Step 4</span>
                            </div>

                            <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3 form-items">
                                             <div class="form-check ps-0 q-box">
                                                 <div class="q-box__question col me-2 d-flex">
                                                    <img class="uploadPreview" src="<?=base_url();?>/frontend/assets/img/user--default-Image.png" width="200" height="200" />
                                                    <div class="uploadsec">
                                                        <label class="form-check-label question__label noLabel">
                                                            <div class="form-label " for=""> Photograph of the Applicant</div>
                                                                <input style="max-width:210px" name="nominator_photo" class="required" type="file" id="nominator_photo">
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

                                   <div class="col-lg-12">
                                         <div class="mb-3 form-items">
                                               <label class="form-label " for="">Category of the Award</label>
                                                <select class="form-control required" name="category" id="category">
                                                     <option value="">-- Select --</option>
                                                    <?php if(is_array($categories)):
                                                          foreach($categories as $ckey=>$cvalue):?>
                                                    <option value="<?=$cvalue['id'];?>" <?=set_select('category',$cvalue['id'], ((isset($editdata['category']) && ($editdata['category']==$cvalue['id']))?TRUE:FALSE));?>><?=$cvalue['name'];?></option>
                                                    <?php   endforeach; 
                                                            endif; ?>                                                
                                                    </select>
                                                <small class="text-danger">
                                                    <?php if(isset($validation) && $validation->getError('category')) {?>
                                                        <?= $error = $validation->getError('category'); ?>
                                                    <?php }?>
                                                </small>
                                         </div>
                                    </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Name of the Applicant</label>
                                        
                                        <input type="text" class="form-control required" placeholder="Enter Application Name" id="nominee_name" name="nominee_name" value="<?=set_value('nominee_name',$editdata['nominee_name']);?>">
                                        <small class="text-danger">
                                        <?php if(isset($validation) && $validation->getError('nominee_name')) {?>
                                            <?= $error = $validation->getError('nominee_name'); ?>
                                        <?php }?>
                                        </small>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Date of Birth</label>
                                        <input type="text" class="form-control required" placeholder="Enter Date of Birth" id="date_of_birth" name="date_of_birth" value="<?=set_value('date_of_birth',$editdata['date_of_birth']);?>">
                                        <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('date_of_birth')) {?>
                                                <?= $error = $validation->getError('date_of_birth'); ?>
                                            <?php }?>
                                        </small>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> Citizenship </label>

                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question col me-2">
                                              <select class="selectpicker mt-2 required"
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
                                                <div class="">
                                                    <small>Indian / NRI (Holding valid Indian Passport–upload a copy of Passport)</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </section>
                        <section>
                        <div class="step">
                        <h3>Step2</h3>
                            <div class="step-status step2"><span>Step 1</span> <span>Step 2</span> <span>Step 3</span>
                                <span>Step 4</span>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Designation & Office Address</label>
                                        <textarea class="required" name="designation_and_office_address" id="designation_and_office_address" placeholder="Write a message"><?=$editdata['designation_and_office_address'];?></textarea>
                                        <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('designation_and_office_address')) {?>
                                                <?= $error = $validation->getError('designation_and_office_address'); ?>
                                            <?php }?>
                                        </small>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Residence Address with Tel/ Cell No. E-mail</label>
                                        <textarea name="residence_address" class="required" id="residence_address" placeholder="Write a message"><?=$editdata['residence_address'];?></textarea>
                                        <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('residence_address')) {?>
                                                <?= $error = $validation->getError('residence_address'); ?>
                                            <?php }?>
                                        </small>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Mobile No.</label>
                                        
                                        <input type="number" class="form-control required" placeholder="Please Enter Mobile No" id="nominee_mobile" name="mobile_no" value="<?=set_value('mobile_no',$editdata['mobile_no']);?>">
                                        <small class="text-danger">
                                        <?php if(isset($validation) && $validation->getError('mobile_no')) {?>
                                            <?= $error = $validation->getError('mobile_no'); ?>
                                        <?php }?>
                                        </small>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Email ID</label>
                                       
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

                        <div class="step">
                        <h3>Step3</h3>
                            <div class="step-status step3"><span>Step 1</span> <span>Step 2</span> <span>Step 3</span>
                                <span>Step 4</span>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Name of the Nominator</label>
                                        <input type="text" placeholder="" class="form-control required" name="nominator_name" id="nominator_name" value="<?=set_value('nominator_name',$editdata['nominator_name']);?>">
                                        <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('nominator_name')) {?>
                                                <?= $error = $validation->getError('nominator_name'); ?>
                                            <?php }?>
                                        </small>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Designation & Office Address of the
                                            Nominator</label>
                                            <textarea class="form-control required" name="nominator_office_address" id="nominator_office_address" placeholder="Write a Address" style="height:auto;"><?=$editdata['nominator_office_address'];?></textarea>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('nominator_office_address')) {?>
                                                <?= $error = $validation->getError('nominator_office_address'); ?>
                                            <?php }?>
                                            </small>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Mobile No of the Nominator</label>
                                     
                                        <input  class="form-control required" type="number" placeholder="" id="nominator_mobile" name="nominator_mobile" value="<?=set_value('nominator_mobile',$editdata['nominator_mobile']);?>">
                                        <small class="text-danger">
                                        <?php if(isset($validation) && $validation->getError('nominator_mobile')) {?>
                                            <?= $error = $validation->getError('nominator_mobile'); ?>
                                        <?php }?>
                                        </small>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Email ID of the Nominator</label>
                                    
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
                                        <label class="form-label " for=""> Attach Justification Letter in pdf format (for Sponsoring the Nomination duly signed by the Nominator, Max : 500 KB) </label>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question col me-2">
                                              <input class="form-control required" name="justification_letter" type="file" id="justification_letter" value="<?=$editdata['justification_letter'];?>">
                                                <?php if(!empty($editdata['justification_letter'])): ?>
                                                    <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['justification_letter'];?>" style="color:blue;"><?=$editdata['justification_letter'];?></a>
                                                    <?php endif;?>
                                                <small class="text-danger">
                                                <?php if(isset($validation) && $validation->getError('justification_letter')) {?>
                                                    <?= $error = $validation->getError('justification_letter'); ?>
                                                <?php }?>
                                                </small>
                                                <div class="">
                                                    <small>Upload Justification letter (not more than 500KB)</small>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                     </section>

                    <section>
                        <div class="step">
                            <h3>Step4</h3>
                            <div class="step-status step4"><span>Step 1</span> <span>Step 2</span> <span>Step 3</span>
                                <span>Step 4</span>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> Complete Bio-data of the applicant(Max: 1.5MB) pdf format </label>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question col me-2">
                                                    <input class="form-control mb-3 required" name="complete_bio_data" type="file" id="complete_bio_data" value="<?=$editdata['complete_bio_data'];?>">   
                                                    <?php if(!empty($editdata['complete_bio_data'])): ?> 
                                                         <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['complete_bio_data'];?>" style="color:blue;"><?=$editdata['complete_bio_data'];?></a>                                        
                                                    <?php endif;?> 
                                                    <div class="">
                                                        <small>Upload the Bio-data (Not more than 1.5 MB)</small>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> In order of Importance, list of 10
                                            best papers of the applicant highlighting the important
                                            discoveries/contributions described in them briefly (Max. 1 MB) </label>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question col me-2">
                                                <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" name="best_papers" type="file" id="best_papers" value="<?=$editdata['best_papers'];?>">  
                                                    <?php if(!empty($editdata['best_papers'])): ?>
                                                    <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['best_papers'];?>" style="color:blue;"><?=$editdata['best_papers'];?></a>    
                                                    <?php endif;?>
                                                </label>
                                                <div class="">
                                                    <small>Upload the List of Publication (Not more than 1 MB) </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> Statement of Research Achievements, if any, on which any Award has already been Received by the Applicant. Please also upload brief citations on the research works for which the applicant has already received the awards (Max: 1 MB) </label>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question col me-2">
                                                <label class="form-check-label question__label noLabel">
                                                  <input class="form-control mb-3 required" name="statement_of_research_achievements" type="file" id="statement_of_research_achievements" value="<?=$editdata['statement_of_research_achievements'];?>"> 
                                                  <?php if(!empty($editdata['statement_of_research_achievements'])): ?>
                                                    <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['statement_of_research_achievements'];?>" style="color:blue;"><?=$editdata['statement_of_research_achievements'];?></a>                                           
                                                  <?php endif;?>
                                                </label>
                                                <div class="">
                                                    <small>Upload the list of awards already received by the applicant
                                                        (Not more than 1MB)
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> Signed details of the excellence in
                                            research work for which the Sun Pharma Research Award is claimed, including
                                            references & illustra- tions (Max. 2.5 MB). The candidate should duly sign
                                            on the details </label>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question col me-2">
                                                <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" name="signed_details" type="file" id="signed_details" value="<?=$editdata['signed_details'];?>">    
                                                    <?php if(!empty($editdata['signed_details'])): ?>
                                                    <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['signed_details'];?>" style="color:blue;"><?=$editdata['signed_details'];?></a>                                        
                                                    <?php endif;?>
                                                </label>
                                                <div class="">
                                                    <small>Upload the details of the research work for which nomination
                                                        is being sent(Not more than 2.5 MB)</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> Two specific publications/research
                                            papers of the applicant relevant to the research work mentioned above (Max.
                                            2.5 MB) </label>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question col me-2">
                                                <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" name="specific_publications" type="file" id="specific_publications" value="<?=$editdata['specific_publications'];?>">  
                                                    <?php if(!empty($editdata['specific_publications'])): ?>
                                                        <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['specific_publications'];?>" style="color:blue;"><?=$editdata['specific_publications'];?></a>                                          
                                                    <?php endif;?>
                                                </label>
                                                <div class="">
                                                    <small>Upload the publication/Research paper (Not more than 2.5 MB)</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> A signed statement by the applicant
                                            that the research work under reference has not been given any award. The
                                            applicant should also indicate the extent of the contribution of others
                                            associated with the research and he/she should clearly acknowledge his/her
                                            achievements. (Max. 500 KB) </label>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question col me-2">
                                                <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" name="signed_statement" type="file" id="signed_statement" value="<?=$editdata['signed_statement'];?>">   
                                                    <br />
                                                    <?php if(!empty($editdata['signed_statement'])): ?>
                                                    <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['signed_statement'];?>" style="color:blue;"><?=$editdata['signed_statement'];?></a>                                         
                                                    <?php endif;?>
                                                </label>
                                                <div class="">
                                                    <small>Upload the signed statement (Not more than 500 KB) </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> Citation on the Research Work of the Applicant duly signed by the Nominator (Max. 300 KB) </label>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question col me-2">
                                                <label class="form-check-label question__label noLabel">
                                                    <input class="form-control mb-3 required" name="citation" type="file" id="citation" value="<?=$editdata['citation'];?>">   
                                                    <br>
                                                    <?php if(!empty($editdata['citation'])): ?>
                                                    <a href="<?=base_url();?>/uploads/<?=$editdata['id'];?>/<?=$editdata['citation'];?>" style="color:blue;"><?=$editdata['citation'];?></a>                                         
                                                    <?php endif;?>
                                                </label>
                                                <div class="">
                                                    <small>Upload the Citation (Not more than 300KB) </small>
                                                </div>
                                            </div>
                                            
                                        </div>

                                    </div>
                                </div>

                            </section>
                            </div>

                        </div>

            <div class="step finalreview">
            <!-- CONTAINER -->
             <div id="mainform-container" class="container py-1 preview">
              <div class="row">
                <div id="mainform-items" class="col-lg-12 mx-0 px-0">
                    <div id="qbox-container">
                        <div class="needs-validation" id="form-wrapper">
                            <div id="steps-container">
                                <div class="step1">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3 form-items">
                                                <div class="form-check ps-0 q-box">
                                                    <div class="q-box__question col me-2 d-flex">
                                                       <img class="uploadPreview" src="<?=base_url();?>/frontend/assets/img/user--default-Image.png" width="200" height="200" />
                                                        <div class="uploadsec">
                                                                <label class="form-check-label question__label noLabel">
                                                                    <div class="form-label"> Photograph of the Applicant
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3 form-items">
                                                <label class="form-label " for="">Category of the Award</label>
                                                <div class="form-control">Medical Sciences-Basic Research
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3 form-items">
                                                <label class="form-label " for="">Name of the Applicant</label>
                                                <div class="form-control">Ajay Krishna
                                                </div>
                                            </div>

                                        </div>


                                        <div class="col-lg-6">
                                            <div class="mb-3 form-items">
                                                <label class="form-label " for="">Date of Birth</label>
                                                <div class="form-control">12/12/1980
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3 form-items">
                                                <label class="form-label " for=""> Citizenship </label>
                                                <div class="form-control"><button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg> View Passport</button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="step2">

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3 form-items">
                                                <label class="form-label " for="">Designation & Office Address</label>
                                                <div class="form-control">Cecilia Chapman<br>
                                                    711-2880 Nulla St.<br>
                                                    Mankato Mississippi 96522<br>
                                                    (257) 563-7401<br>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3 form-items">
                                                <label class="form-label " for="">Residence Address with Tel/ Cell No.
                                                    E-mail</label>
                                                    <div class="form-control">Kyla Olsen<br>
                                                        Ap #651-8679 Sodales Av.<br>
                                                        Tamuning PA 10855<br>
                                                        (654) 393-5734
                                                    </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3 form-items">
                                                <label class="form-label " for="">Mobile No.</label>
                                                <div class="form-control">9876543210
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3 form-items">
                                                <label class="form-label " for="">Email ID</label>
                                                <div class="form-control">john@gmail.com
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="step3">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="mb-3 form-items">
                                                <label class="form-label " for="">Name of the Nominator</label>
                                                <div class="form-control">Wilson
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3 form-items">
                                                <label class="form-label " for="">Designation & Office Address of the
                                                    Nominator</label>
                                                    <div class="form-control">Nyssa Vazquez<br>
                                                        511-5762 At Rd.<br>
                                                        Chelsea MI 67708<br>
                                                        (947) 278-5929
                                                    </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3 form-items">
                                                <label class="form-label " for="">Mobile No of the Nominator</label>
                                                <div class="form-control">1234567890
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3 form-items">
                                                <label class="form-label " for="">Email ID of the Nominator</label>
                                                <div class="form-control">wilson@gmail.com
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3 form-items">
                                                <label class="form-label " for=""> Justification for Sponsoring the
                                                    Nomination duly signed by the Nominator (not to exceed 400 words) </label>
                                                    <div class="form-control"><button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                    </svg> View Justification letter</button>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="step4">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3 form-items">
                                                <label class="form-label " for=""> Complete Bio-data of the Applicant
                                                    (Max 1.5 MB) </label>
                                                    <div class="form-control"><button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                    </svg> View Bio-data</button>
                                                    </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3 form-items">
                                                <label class="form-label " for=""> In order of Importance, list of 10
                                                    best papers of the applicant highlighting the important
                                                    discoveries/contributions described in them briefly (Max. 1 MB) </label>
                                                    <div class="form-control"><button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                    </svg>View Publication</button>
                                                    </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3 form-items">
                                                <label class="form-label " for=""> Statement of Research Achievements, if
                                                    any, on which any Award has already been Received by the Applicant. Please
                                                    also upload brief citations on the research works for which the applicant
                                                    has already received the awards (Max. 1 MB) </label>
                                                    <div class="form-control"><button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                    </svg> View Award History</button>
                                                    </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3 form-items">
                                                <label class="form-label " for=""> Signed details of the excellence in
                                                    research work for which the Sun Pharma Research Award is claimed, including
                                                    references & illustra- tions (Max. 2.5 MB). The candidate should duly sign
                                                    on the details </label>
                                                    <div class="form-control"><button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                    </svg> Details of the research work</button>
                                                    </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3 form-items">
                                                <label class="form-label " for=""> Two specific publications/research
                                                    papers of the applicant relevant to the research work mentioned above (Max.
                                                    2.5 MB) </label>
                                                    <div class="form-control"><button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                    </svg> View Research Papers</button>
                                                    </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3 form-items">
                                                <label class="form-label " for=""> A signed statement by the applicant
                                                    that the research work under reference has not been given any award. The
                                                    applicant should also indicate the extent of the contribution of others
                                                    associated with the research and he/she should clearly acknowledge his/her
                                                    achievements. (Max. 500 KB) </label>
                                                    <div class="form-control">
                                                        <button class="btn btn-primary btn-sm" type="button">
                                                        <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                             <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                       </svg> View Statement</button>
                                                    </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3 form-items">
                                                   <label class="form-label " for=""> Citation on the Research Work of the
                                                    Applicant duly signed by the Nominator (Max. 300 KB) </label>
                                                    <div class="form-control"><button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                        </svg> View Citation</button>
                                                    </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        
        </div>

            <div id="success">
                <div class="mt-5">
                    <h4>Success! We'll get back to you ASAP!</h4>
                    <p>Meanwhile, clean your hands often, use soap and water, or an alcohol-based hand rub,
                        maintain a safe distance from anyone who is coughing or sneezing and always wear a
                        mask when physical distancing is not possible.</p>
                    <a class="back-link" href="">Go back from the beginning ➜</a>
                </div>
            </div>
       </div>
            <div id="q-box__buttons">
                <button id="prev-btn" class="btn btn-primary  me-2" type="button">Previous</button>
                <button id="next-btn" class="btn btn-primary" type="button">Next</button>
                <button id="submit-btn" class="btn btn-success ms-2" type="submit">Submit</button>
            </div>
        </div>
        </div>
    </form>
  </div>
</div>
<!-- PRELOADER -->
<div id="preloader-wrapper">
    <div id="preloader"></div>
    <div class="preloader-section section-left"></div>
    <div class="preloader-section section-right"></div>
</div></section>