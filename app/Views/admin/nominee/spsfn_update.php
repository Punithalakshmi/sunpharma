<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add/Modify User</h3>
              </div>

              </div>

              <div class="actionbtns">
                <a class="btn btn-primary" href="<?=base_url();?>/admin/user">
                  <i class="fa fa-arrow-left"></i> BACK
                </a>           
              </div>


            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                
                  <div class="x_content">
                    <br />
                    <form id="nomineeUpdate" enctype="multipart/form-data" action="<?php echo base_url();?>/admin/nominee/update" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                      <input type="hidden" name="id" value="<?=$editdata['id'];?>"  >
                      <?= csrf_field(); ?>
                      <div class="form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Photograph of the Applicant 
                                <span class="required" style="color:red;">*</span>
                                  <div class="hintcont">
                                    <small>Not more than 500 KB</small>
                                </div>
                              </label>
                              <input type="file" class="form-control col-md-6 required" accept="image/*" name="nominator_photo" id="nominator_photo" value="<?=set_value('nominator_photo',$editdata['nominator_photo']);?>" />
                              <img  src="<?=base_url();?>/frontend/assets/img/user--default-Image.png" width="50"
                              height="50" />
                              <br />
                      </div>
                      <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Category of the Award <span class="required" style="color:red;">*</span></label>
                                    <select class="form-control col-md-6 selectpicker mt-2 required" name="category" id="category">
                                    <option value="">-- Select --</option>
                                        <?php if(is_array($categories)):
                                                foreach($categories as $ckey=>$cvalue):?>
                                         <option value="<?=$cvalue['id'];?>" <?=set_select('category',$cvalue['id'], ((isset($editdata['category']) && ($editdata['category']==$cvalue['id']))?TRUE:FALSE));?>><?=$cvalue['name'];?></option>
                                        <?php   endforeach; 
                                                endif; ?>     
                                    </select>
                                </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                              Applicant Name <span class="required" style="color:red;">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="firstname" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('firstname',$editdata['firstname']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-md-6">
                      
                      </div>
                      <div class="clearfix"></div>
                    
                      
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required" style="color:red;">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="email" class="form-control col-md-7 col-xs-12" type="text" name="email" value="<?php echo set_value('email',$editdata['email']);?>">
                        </div>
                       
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-md-6">
                     
                      </div>
                    
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth 
                              <span class="required" style="color:red;">*</span> 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="single_cal3" name="date_of_birth" class="date-picker form-control col-md-7 col-xs-12" type="text" value="<?php echo set_value('date_of_birth',$editdata['dob']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number <span class="required" style="color:red;">*</span> </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input id="mobile_no" class="form-control col-md-7 col-xs-12" type="number" name="mobile_no" value="<?php echo set_value('mobile_no',$editdata['phone']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-md-6">
                      
                      </div>
                        <div class="clearfix"></div>

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Address <span class="required" style="color:red;">*</span> </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <textarea name="designation_and_office_address" class="form-control col-md-7 col-xs-12"><?=$editdata['address'];?></textarea>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-md-6">
                      
                      </div>
                        <div class="clearfix"></div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 " for="">Citizenship <span class="required" style="color:red;">*</span></label>
                            <select class="form-control col-md-6 selectpicker mt-2 required"
                                aria-label="Default select example" id="citizenship" name="citizenship" value="<?=set_value('citizenship',$editdata['citizenship']);?>">
                                <option value="">-- Select --</option>
                                <option value="1" <?=set_select('citizenship', 1, ((isset($editdata['citizenship']) && ($editdata['citizenship']==1))?TRUE:FALSE));?>>Indian</option>
                                <option value="2" <?=set_select('citizenship', 2, ((isset($editdata['citizenship']) && ($editdata['citizenship']==2))?TRUE:FALSE));?>>Other</option>
                            </select>
                           
                        </div>      
                        <div class="clearfix"></div>

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Residence Address <span class="required" style="color:red;">*</span> </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                             <textarea name="residence_address" class="form-control col-md-7 col-xs-12"><?=$editdata['residence_address'];?></textarea>
                         
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-md-6">
                      
                      </div>
                        <div class="clearfix"></div>

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nominator Name <span class="required" style="color:red;">*</span> </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input id="nominator_name" class="form-control col-md-7 col-xs-12" type="text" name="nominator_name" value="<?php echo set_value('nominator_name',$editdata['nominator_name']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-md-6">
                    
                      </div>
                        <div class="clearfix"></div>

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nominator Mobile <span class="required" style="color:red;">*</span> </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input id="nominator_mobile" class="form-control col-md-7 col-xs-12" type="number" name="nominator_mobile" value="<?php echo set_value('nominator_mobile',$editdata['nominator_phone']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-md-6">
                     
                      </div>
                        <div class="clearfix"></div>

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nominator Email<span class="required" style="color:red;">*</span> </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input id="nominator_email" class="form-control col-md-7 col-xs-12" type="number" name="nominator_email" value="<?php echo set_value('nominator_email',$editdata['nominator_email']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-md-6">
                      
                      </div>
                        <div class="clearfix"></div>

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nominator Designation <span class="required" style="color:red;">*</span> </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input id="nominator_designation" class="form-control col-md-7 col-xs-12" type="number" name="nominator_designation" value="<?php echo set_value('nominator_designation',$editdata['nominator_designation']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-md-6">
                      
                      </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nominator Address <span class="required" style="color:red;">*</span> </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <textarea name="nominator_address" class="form-control col-md-7 col-xs-12"><?=$editdata['nominator_address'];?></textarea>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-md-6">
                    
                      </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                                 <div class="mb-3 form-items">
                                      <label class="form-label" for="">  
                                        Letter from the supervisor certifying that the research work submitted for Sun Pharma Science Scholar Award has actually been done by the applicant
                                     </label>
                                    <button type="button" name="supervisor_certifying_add" id="add_more_supervisor_certifying" onclick="addMoreRows('supervisorWrapper','supervisor_certifying','supervisor_certifying');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>
                                    <div class="supervisorWrapper" id="supervisorWrapper">
                                       <!-- <input class="form-control mb-3 required supervisor_certifying" accept=".pdf" name="supervisor_certifying[]" type="file" id="supervisor_certifying" value="<?//$editdata['supervisor_certifying'];?>">    -->
                                    </div> 
                                    <?php if(!empty($editdata['supervisor_certifying'])): ?>
                                      <div>
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$editdata['supervisor_certifying'];?>" target="_blank">
                                            <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg> View
                                            </button>
                                          </a>
                                      </div>
                                    <?php endif;?>
                                  </div>                    
                              </div>  

                              <div class="clearfix"></div>
                              <div class="form-group">
                                <div class="mb-3 form-items">
                                    <label class="form-label " for=""> Complete Bio-data of the Applicant
                                        (Max 1.5 MB) <span class="required" style="color:red;">*</span>
                                        <div class="">
                                            <small>Upload the Bio-data (Not more than 1.5 MB)</small>
                                        </div>
                                    </label>
                                    
                                      <button type="button" name="bio_add" id="add_more_bio_data" onclick="addMoreRows('bioDataWrapper','complete_bio_data','complete_bio_data');" class="btn btn-primary btn-sm add_more_bio_data">
                                          <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                            <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                          </svg> ADD
                                        </button>
                                      <div class="bioDataWrapper" id="bioDataWrapper">
                                         
                                      </div>
                                  
                                    <div class="clearfix"></div>
                                    <?php if(!empty($editdata['complete_bio_data'])): ?>
                                    <div>
                                        <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$editdata['complete_bio_data'];?>" target="_blank">
                                          <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                            <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View
                                          </button>
                                        </a>
                                    </div>
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                              <div class="form-group">
                                 <div class="mb-3 form-items">
                                      <label class="form-label" for=""> Details of the excellence in research work for which the Sun Pharma Science Scholar Award is claimed, including references and illustrations with following headings- Title, Introduction, Objectives, Materials and Methods, Results, Statistical Analysis, Discussion, Impact of the research in the advancement of knowledge or benefit to mankind, Literature reference. The candidate should duly sign on the details.(Max 2 MB) <span class="required" style="color:red;">*</span>
                                         
                                     </label>
                                    <button type="button" name="excellence_research_work_add" id="add_more_excellence_research_work" onclick="addMoreRows('excellenceResearchWrapper','excellence_research_work','excellence_research_work');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>
                                    <div class="excellenceResearchWrapper" id="excellenceResearchWrapper">
                                      
                                    </div> 
                                    <?php if(!empty($editdata['excellence_research_work'])): ?>
                                      <div>
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$editdata['excellence_research_work'];?>" target="_blank">
                                            <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg> View
                                            </button>
                                          </a>
                                      </div>
                                    <?php endif;?>
                                  </div>                    
                              </div>  

                              <div class="clearfix"></div>
                              <div class="form-group">
                                 <div class="mb-3 form-items">
                                      <label class="form-label"> List of Publications, if any. If yes, Upload copies of any two publications (Max: 2 MB)
                                         
                                     </label>
                                    <button type="button" name="lists_of_publications_add" id="add_more_lists_of_publications" onclick="addMoreRows('listofPublicationsWrapper','lists_of_publications','lists_of_publications');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>
                                    <div class="listofPublicationsWrapper" id="listofPublicationsWrapper">
                                       
                                    </div> 
                                    <?php if(!empty($editdata['lists_of_publications'])): ?>
                                      <div>
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$editdata['lists_of_publications'];?>" target="_blank">
                                            <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg> View
                                            </button>
                                          </a>
                                      </div>
                                    <?php endif;?>
                                  </div>                    
                              </div>  

                              <div class="clearfix"></div>
                        <div class="form-group">
                                 <div class="mb-3 form-items">
                                      <label class="form-label" for="">Statement of Merits/Awards/Scholarships already received by the Applicant (Max: 1 MB)
                                     </label>
                                    <button type="button" name="statement_of_applicant_add" id="add_more_statement_of_applicant" onclick="addMoreRows('statementOfApplicantWrapper','statement_of_applicant','statement_of_applicant');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>
                                    <div class="statementOfApplicantWrapper" id="statementOfApplicantWrapper">
                                      
                                    </div> 
                                    <?php if(!empty($editdata['statement_of_applicant'])): ?>
                                      <div>
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$editdata['statement_of_applicant'];?>" target="_blank">
                                            <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg> View
                                            </button>
                                          </a>
                                      </div>
                                    <?php endif;?>
                                  </div>                    
                              </div>  

                              <div class="clearfix"></div>
                        <div class="form-group">
                                 <div class="mb-3 form-items">
                                      <label class="form-label" for="">A letter stating that the project submitted for the award has received “ethical clearance” (Max: 250KB)
                                     </label>
                                    <button type="button" name="ethical_clearance_add" id="add_more_ethical_clearance" onclick="addMoreRows('ethicalClearanceWrapper','ethical_clearance','ethical_clearance');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>
                                    <div class="ethicalClearanceWrapper" id="ethicalClearanceWrapper">
                                      
                                    </div> 
                                    <?php if(!empty($editdata['ethical_clearance'])): ?>
                                      <div>
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$editdata['ethical_clearance'];?>" target="_blank">
                                            <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg> View
                                            </button>
                                          </a>
                                      </div>
                                    <?php endif;?>
                                  </div>                    
                              </div>  

                              <div class="clearfix"></div>
                        <div class="form-group">
                                 <div class="mb-3 form-items">
                                      <label class="form-label" for=""> A statement duly signed by the nominee and the supervisor/co-author that academically or financially the thesis submitted for Sun Pharma Science Scholar Award-2021 has “non-conflict of interest” with the supervisor or co-authors (Max: 250KB)
                                     </label>
                                    <button type="button" name="statement_of_duly_signed_by_nominee_add" id="add_more_statement_of_duly_signed_by_nominee" onclick="addMoreRows('statementOfDulySignedWrapper','statement_of_duly_signed_by_nominee','statement_of_duly_signed_by_nominee');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>
                                    <div class="statementOfDulySignedWrapper" id="statementOfDulySignedWrapper">
                                       
                                    </div> 
                                    <?php if(!empty($editdata['statement_of_duly_signed_by_nominee'])): ?>
                                      <div>
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$editdata['statement_of_duly_signed_by_nominee'];?>" target="_blank">
                                            <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg> View
                                            </button>
                                          </a>
                                      </div>
                                    <?php endif;?>
                                  </div>                    
                              </div>  

                              <div class="clearfix"></div>
                        <div class="form-group">
                                 <div class="mb-3 form-items">
                                      <label class="form-label" for=""> Citation (brief summary) on the Research Work of the Applicant duly signed by the Nominator (Max: 300 KB)
                                     </label>
                                    <button type="button" name="citation_add" id="add_more_citation" onclick="addMoreRows('citationWrapper','citation','citation');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>
                                    <div class="citationWrapper" id="citationWrapper">
                                       
                                    </div> 
                                    <?php if(!empty($editdata['citation'])): ?>
                                      <div>
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$editdata['citation'];?>" target="_blank">
                                            <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg> View
                                            </button>
                                          </a>
                                      </div>
                                    <?php endif;?>
                                  </div>                    
                              </div>  

                              <div class="clearfix"></div>
                        <div class="form-group">
                                 <div class="mb-3 form-items">
                                      <label class="form-label" for=""> Aggregate marks obtained in PCB/PCM in Class XII or any other course (Max: 250 KB)
                                     </label>
                                    <button type="button" name="aggregate_marks_add" id="add_more_aggregate_marks" onclick="addMoreRows('aggregateMarksWrapper','aggregate_marks','aggregate_marks');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>
                                    <div class="aggregateMarksWrapper" id="aggregateMarksWrapper">
                                       
                                    </div> 
                                    <?php if(!empty($editdata['aggregate_marks'])): ?>
                                      <div>
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$editdata['aggregate_marks'];?>" target="_blank">
                                            <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg> View
                                            </button>
                                          </a>
                                      </div>
                                    <?php endif;?>
                                  </div>                    
                              </div>  

                              <div class="clearfix"></div>
                        <div class="form-group">
                                 <div class="mb-3 form-items">
                                      <label class="form-label" for=""> Age proof (Max: 250KB)
                                     </label>
                                    <button type="button" name="age_proof_add" id="add_more_age_proof" onclick="addMoreRows('ageProofWrapper','age_proof','age_proof');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>
                                    <div class="ageProofWrapper" id="ageProofWrapper">
                                      
                                    </div> 
                                    <?php if(!empty($editdata['age_proof'])): ?>
                                      <div>
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$editdata['age_proof'];?>" target="_blank">
                                            <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg> View
                                            </button>
                                          </a>
                                      </div>
                                    <?php endif;?>
                                  </div>                    
                              </div>  

                              <div class="clearfix"></div>
                        <div class="form-group">
                                 <div class="mb-3 form-items">
                                      <label class="form-label" for=""> A voluntary declaration from the candidate that they would work in the public or private funded academic/research based organizations for a minimum period of two years after completion of his/her studies. (Max: 250KB)
                                     </label>
                                    <button type="button" name="declaration_candidate_add" id="add_more_declaration_candidate" onclick="addMoreRows('declarationWrapper','declaration_candidate','declaration_candidate');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>
                                    <div class="declarationWrapper" id="declarationWrapper">
                                      
                                    </div> 
                                    <?php if(!empty($editdata['declaration_candidate'])): ?>
                                      <div>
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$editdata['declaration_candidate'];?>" target="_blank">
                                            <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg> View
                                            </button>
                                          </a>
                                      </div>
                                    <?php endif;?>
                                  </div>                    
                              </div>  

                              <div class="clearfix"></div>
                              <div class="form-group">
                                 <div class="mb-3 form-items">
                                      <label class="form-label" for=""> Citation on the Research Work of the
                                           Applicant duly signed by the Nominator (Max. 300 KB) <span class="required" style="color:red;">*</span>
                                          <div class=""><small>Upload the Citation (Not more than 300KB) </small></div>
                                     </label>
                                    <button type="button" name="citation_add" id="add_more_citation" onclick="addMoreRows('citationWrapper','citation','citation');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>
                                    <div class="citationWrapper" id="citationWrapper">
                                      
                                    </div> 
                                    <?php if(!empty($editdata['citation'])): ?>
                                      <div>
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$editdata['citation'];?>" target="_blank">
                                            <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg> View
                                            </button>
                                          </a>
                                      </div>
                                    <?php endif;?>
                                  </div>                    
                              </div>  


                          <div class="clearfix"></div>
                         
                         <div class="ln_solid"></div>
                          <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                              
                              <a href="<?=base_url();?>/admin/user" class="btn btn-primary">CANCEL</a>
                                <input type="submit" class="btn btn-success" name="submit" value="SAVE">
                            </div>
                          </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
