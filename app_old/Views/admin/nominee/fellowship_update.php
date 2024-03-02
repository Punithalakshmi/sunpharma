<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add/Modify User</h3>
              </div>

              </div>

              <div class="actionbtns">
                <a class="btn btn-primary" href="<?=base_url();?>/admin/nominee/view/<?=$editdata['user_id'];?>">
                  <i class="fa fa-arrow-left"></i> BACK
                </a>           
              </div>


            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <?php 

                      if(strpos($editdata['justification_letter_filename'],','))
                         $justificationLetter = explode(',',$editdata['justification_letter_filename']);
                      else
                         $justificationLetter = $editdata['justification_letter_filename'];


                      if(strpos($editdata['complete_bio_data'],','))
                        $completeBiodata = explode(',',$editdata['complete_bio_data']);
                      else
                        $completeBiodata = $editdata['complete_bio_data'];  

                      if(strpos($editdata['fellowship_research_experience'],','))
                        $researchExperience = explode(',',$editdata['fellowship_research_experience']);
                      else
                        $researchExperience = $editdata['fellowship_research_experience']; 

                      if(strpos($editdata['fellowship_research_publications'],','))
                         $researchPublications = explode(',',$editdata['fellowship_research_publications']);
                      else
                         $researchPublications = $editdata['fellowship_research_publications']; 

                      if(strpos($editdata['fellowship_research_awards_and_recognitions'],','))
                         $awardsRecognitions = explode(',',$editdata['fellowship_research_awards_and_recognitions']);
                      else
                         $awardsRecognitions = $editdata['fellowship_research_awards_and_recognitions']; 

                      if(strpos($editdata['fellowship_scientific_research_projects'],','))
                         $scientificResearchProjects = explode(',',$editdata['fellowship_scientific_research_projects']);
                      else
                         $scientificResearchProjects = $editdata['fellowship_scientific_research_projects']; 

                      if(strpos($editdata['fellowship_description_of_research'],','))
                         $descriptionOfResearch = explode(',',$editdata['fellowship_description_of_research']);
                      else
                         $descriptionOfResearch = $editdata['fellowship_description_of_research']; 

                     
                      if(strpos($editdata['first_degree_marksheet'],','))
                         $firstDegreeMarksheet = explode(',',$editdata['first_degree_marksheet']);
                      else
                         $firstDegreeMarksheet = $editdata['first_degree_marksheet']; 

                      if(strpos($editdata['highest_degree_marksheet'],','))
                         $highestDegreeMarksheet = explode(',',$editdata['highest_degree_marksheet']);
                      else
                         $highestDegreeMarksheet = $editdata['highest_degree_marksheet'];    
                      

                    ?>
                  <div class="x_content">
                    <br />
                   
                    <form id="nomineeUpdate" enctype="multipart/form-data" action="<?php echo base_url();?>/admin/nominee/update/<?=$editdata['user_id'];?>" method="POST" data-parsley-validate class="form-horizontal form-label-left addformsec">
                      <input type="hidden" name="id" value="<?=$editdata['id'];?>"  >
                      <?= csrf_field(); ?>
                     
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
                          <input id="single_cal3" name="date_of_birth" class="date-picker form-control col-md-7 col-xs-12" type="text" value="<?php echo set_value('date_of_birth',date('m/d/Y',strtotime($editdata['dob'])));?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <?php if(isset($editdata['age']) && !empty($editdata['age'])): ?>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Age
                              
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="single_cal3" name="age" class="form-control col-md-7 col-xs-12" type="text" readonly >
                        </div>
                      </div>
                      <?php endif;?>
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
                         <input id="nominator_email" class="form-control col-md-7 col-xs-12" type="text" name="nominator_email" value="<?php echo set_value('nominator_email',$editdata['nominator_email']);?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-md-6">
                      
                      </div>
                        <div class="clearfix"></div>

                        <div class="form-group">
                          <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nominator Designation <span class="required" style="color:red;">*</span> </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input id="nominator_designation" class="form-control col-md-7 col-xs-12" type="text" name="nominator_designation" value="<?php echo set_value('nominator_designation',$editdata['nominator_designation']);?>">
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
                      <div class="form-group uploadseciz">
                        <div class="mb-3 form-items">
                            <label class="form-label"> Justification for Sponsoring the
                                Nomination duly signed by the Nominator (not to exceed 400 words) </label>

                                <button type="button" name="justification_add" id="add_more_justification" onclick="addMoreRows('justificationWrapper','justification_letter','justification_letter');" class="btn btn-primary btn-sm add_more_justification">
                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                  </svg> ADD
                                </button>

                                <?php if(is_array($justificationLetter)): 
                                    for($i=0; $i<count($justificationLetter); $i++): if(!empty($justificationLetter[$i])): ?>
                                     <div class="mb-3 form-items" id="justificationLtr<?=$i;?>">
                                        <input class="form-control mb-3 required complete_bio_data" accept=".pdf" name="justification_letter[<?=$justificationLetter[$i];?>]" type="file">
                                       
                                         <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$justificationLetter[$i];?>" target="_blank" title="<?=$justificationLetter[$i];?>">
                                              <button class="btn btn-primary btn-sm" type="button">
                                                <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg>
                                                <?=$justificationLetter[$i];?>
                                              </button>
                                          </a>
                                        <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$justificationLetter[$i];?>','<?=$editdata['user_id'];?>','justificationLtr<?=$i;?>','justification_letter_filename',<?=$editdata['nominee_detail_id']?>);">X</button>
                                    </div>   
                                  <?php endif; endfor; 
                                      else:
                                        if(!empty($justificationLetter)): ?>
                                      <div class="mb-3 form-items" id="justificationLtr-1">
                                         
                                        <input class="form-control mb-3 required complete_bio_data" accept=".pdf" name="justification_letter[<?=$justificationLetter;?>]" type="file">
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$justificationLetter;?>" target="_blank" title="<?=$justificationLetter;?>">
                                            <button class="btn btn-primary btn-sm" type="button">
                                                <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg>
                                               <?=$justificationLetter;?>
                                               </button>
                                          </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$justificationLetter;?>','<?=$editdata['user_id'];?>','justificationLtr-1','justification_letter_filename',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>  
                                  <?php endif; endif;?> 
                                  
                                  <div class="justificationWrapper" id="justificationWrapper"> 
                                  </div> 
                             </div>
                          </div>

                        <div class="clearfix"></div>
                              <div class="form-group uploadseciz">
                                <div class="mb-3 form-items">
                                    <label class="form-label"> Complete Bio-data of the Applicant
                                        (Max 1.5 MB) <span class="required" style="color:red;">*</span>
                                        <div class="">
                                            <small>Upload the Bio-data (Not more than 1.5 MB)</small>
                                        </div>
                                    </label>
                                    
                                       <button type="button" name="bio_add" id="add_more_bio_data" onclick="addMoreRows('bioDataWrapper','complete_bio_data','complete_bio_data');" class="btn btn-primary btn-sm add_more_bio_data">
                                          <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                            <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                          </svg>ADD
                                        </button>

                                        <?php if(is_array($completeBiodata)): 
                                    for($i=0; $i<count($completeBiodata); $i++): if(!empty($completeBiodata[$i])): ?>
                                     <div class="mb-3 form-items" id="complete_bio_data<?=$i;?>">
                                        <input class="form-control mb-3 required complete_bio_data" accept=".pdf" name="complete_bio_data[<?=$completeBiodata[$i];?>]" type="file">
                                       
                                         <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$completeBiodata[$i];?>" target="_blank" title="<?=$completeBiodata[$i];?>">
                                              <button class="btn btn-primary btn-sm" type="button">
                                                <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg>
                                                <?=$completeBiodata[$i];?>
                                            </button>
                                        </a>
                                        <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$completeBiodata[$i];?>','<?=$editdata['user_id'];?>','complete_bio_data<?=$i;?>','complete_bio_data',<?=$editdata['nominee_detail_id']?>);">X</button>
                                    </div>   
                                  <?php endif; endfor; 
                                      else: 
                                         if(!empty($completeBiodata)): ?>
                                      <div class="mb-3 form-items" id="complete_bio_data-1">
                                         
                                        <input class="form-control mb-3 required complete_bio_data" accept=".pdf" name="complete_bio_data[<?=$completeBiodata;?>]" type="file">
                                        <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$completeBiodata;?>" target="_blank" title="<?=$completeBiodata;?>">
                                          <button class="btn btn-primary btn-sm" type="button">
                                                <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg>
                                               <?=$completeBiodata;?>
                                               </button>
                                              </a>
                                        <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$completeBiodata;?>','<?=$editdata['user_id'];?>','complete_bio_data-1','complete_bio_data',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>  
                                  <?php endif; endif;?> 
                                  <div class="bioDataWrapper" id="bioDataWrapper"></div>
                                  
                                </div>
                            </div>

                            <div class="clearfix"></div>

                              <div class="form-group uploadseciz">
                                 <div class="mb-3 form-items">
                                    <label class="form-label">First employment:  
                                      <!-- <span class="required" style="color:red;">*</span> -->
                                    </label>
                                    
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                           <label class="form-label">Name of institution and location:</label>
                                          <input id="first_employment_name_of_institution_location" class="form-control col-md-7 col-xs-12" type="text" name="first_employment_name_of_institution_location" value="<?php echo set_value('first_employment_name_of_institution_location',$editdata['first_employment_name_of_institution_location']);?>">
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                           <label class="form-label"> Designation/post:</label>
                                            <input id="first_employment_designation" class="form-control col-md-7 col-xs-12" type="text" name="first_employment_designation" value="<?php echo set_value('first_employment_designation',$editdata['first_employment_designation']);?>">
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                    <label class="form-label">Year of joining:</label>
                                        <input id="first_employment_year_of_joining" class="form-control col-md-7 col-xs-12" type="text" name="first_employment_year_of_joining" value="<?php echo set_value('first_employment_year_of_joining',$editdata['first_employment_year_of_joining']);?>">
                                    </div>
                                    
                                  </div>                    
                              </div>  

                              <div class="clearfix"></div>
                              <div class="form-group uploadseciz">
                                 <div class="mb-3 form-items">
                                    <label class="form-label">First medical degree obtained:   
                                      <!-- <span class="required" style="color:red;">*</span> -->
                                    </label>
                                    
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                           <label class="form-label">Name of degree:</label>
                                          <input id="first_medical_degree_name_of_degree" class="form-control col-md-7 col-xs-12" type="text" name="first_medical_degree_name_of_degree" value="<?php echo set_value('first_medical_degree_name_of_degree',$editdata['first_medical_degree_name_of_degree']);?>">
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                           <label class="form-label"> Year of award of degree:</label>
                                            <input id="first_medical_degree_year_of_award" class="form-control col-md-7 col-xs-12" type="text" name="first_medical_degree_year_of_award" value="<?php echo set_value('first_medical_degree_year_of_award',$editdata['first_medical_degree_year_of_award']);?>">
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                    <label class="form-label">Institution awarding the degree:</label>
                                        <input id="first_medical_degree_institution" class="form-control col-md-7 col-xs-12" type="text" name="first_medical_degree_institution" value="<?php echo set_value('first_medical_degree_institution',$editdata['first_medical_degree_institution']);?>">
                                    </div>
                                    <div class="col-md-12 m20 col-sm-4 col-xs-12">
                                      <label class="form-label">Marksheet:</label>
                                        <button type="button" name="first_degree_marksheet_add" id="add_more_first_degree_marksheet" onclick="addMoreRows('firstDegreeMarksheetWrapper','first_degree_marksheet','first_degree_marksheet');" class="btn btn-primary btn-sm">
                                        <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                          <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                        </svg> ADD
                                      </button>
                                      <?php if(is_array($firstDegreeMarksheet)): 
                                      for($i=0; $i<count($firstDegreeMarksheet); $i++): if(!empty($firstDegreeMarksheet[$i])): ?>
                                       <div class="mb-3 form-items" id="firstDegreeMarksheet<?=$i;?>">
                                          <input class="form-control mb-3 required first_degree_marksheet" accept=".pdf" name="first_degree_marksheet[<?=$firstDegreeMarksheet[$i];?>]" type="file">
                                        
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$firstDegreeMarksheet[$i];?>" target="_blank" title="<?=$firstDegreeMarksheet[$i];?>">
                                                <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                  <?=$firstDegreeMarksheet[$i];?>
                                              </button>
                                          </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$firstDegreeMarksheet[$i];?>','<?=$editdata['user_id'];?>','firstDegreeMarksheet<?=$i;?>','first_degree_marksheet',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>   
                                    <?php endif; endfor; 
                                        else: 
                                          if(!empty($firstDegreeMarksheet)): ?>
                                        <div class="mb-3 form-items" id="firstDegreeMarksheet-1">
                                          
                                          <input class="form-control mb-3 required first_degree_marksheet" accept=".pdf" name="first_degree_marksheet[<?=$firstDegreeMarksheet;?>]" type="file">
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$firstDegreeMarksheet;?>" target="_blank" title="<?=$firstDegreeMarksheet;?>">
                                            <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                <?=$firstDegreeMarksheet;?>
                                                </button>
                                                </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$firstDegreeMarksheet;?>','<?=$editdata['user_id'];?>','firstDegreeMarksheet-1','first_degree_marksheet',<?=$editdata['nominee_detail_id']?>);">X</button>
                                        </div>  
                                        <?php endif; endif;?> 

                                        <div class="firstDegreeMarksheetWrapper" id="firstDegreeMarksheetWrapper">
                                          
                                        </div> 
                                  </div>                      
                              </div>
                          </div>     

                              <div class="clearfix"></div>
                              <div class="form-group uploadseciz">
                                 <div class="mb-3 form-items">
                                    <label class="form-label">Highest medical degree obtained:</label>
                                    
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                           <label class="form-label">Name of degree:</label>
                                           <input id="highest_medical_degree_name" class="form-control col-md-7 col-xs-12" type="text" name="highest_medical_degree_name" value="<?php echo set_value('highest_medical_degree_name',$editdata['highest_medical_degree_name']);?>">
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                            <label class="form-label"> Year of award of degree:</label>
                                            <input id="highest_medical_degree_year" class="form-control col-md-7 col-xs-12" type="text" name="highest_medical_degree_year" value="<?php echo set_value('highest_medical_degree_year',$editdata['highest_medical_degree_year']);?>">
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                          <label class="form-label">Institution awarding the degree:</label>
                                          <input id="highest_medical_degree_institution" class="form-control col-md-7 col-xs-12" type="text" name="highest_medical_degree_institution" value="<?php echo set_value('highest_medical_degree_institution',$editdata['highest_medical_degree_institution']);?>">
                                      </div>
                                      <div class="col-md-12 mt20 col-sm-4 col-xs-12">
                                          <label class="form-label">Marksheet:</label>
                                          <button type="button" name="highest_degree_marksheet_add" id="add_more_highest_degree_marksheet" onclick="addMoreRows('highestDegreeMarksheetWrapper','highest_degree_marksheet','highest_degree_marksheet');" class="btn btn-primary btn-sm">
                                          <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                            <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                          </svg> ADD
                                        </button>
                                      <?php if(is_array($highestDegreeMarksheet)): 
                                      for($i=0; $i<count($highestDegreeMarksheet); $i++): if(!empty($highestDegreeMarksheet[$i])): ?>
                                      <div class="mb-3 form-items" id="highestDegreeMarksheet<?=$i;?>">
                                          <input class="form-control mb-3 required highest_degree_marksheet" accept=".pdf" name="highest_degree_marksheet[<?=$highestDegreeMarksheet[$i];?>]" type="file">
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$highestDegreeMarksheet[$i];?>" target="_blank" title="<?=$highestDegreeMarksheet[$i];?>">
                                                <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                  <?=$highestDegreeMarksheet[$i];?>
                                              </button>
                                          </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$highestDegreeMarksheet[$i];?>','<?=$editdata['user_id'];?>','highestDegreeMarksheet<?=$i;?>','highest_degree_marksheet',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>   
                                    <?php endif; endfor; 
                                        else: 
                                          if(!empty($highestDegreeMarksheet)): ?>
                                        <div class="mb-3 form-items" id="highestDegreeMarksheet-1">
                                          
                                          <input class="form-control mb-3 required highest_degree_marksheet" accept=".pdf" name="highest_degree_marksheet[<?=$highestDegreeMarksheet;?>]" type="file">
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$highestDegreeMarksheet;?>" target="_blank" title="<?=$highestDegreeMarksheet;?>">
                                            <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                <?=$highestDegreeMarksheet;?>
                                                </button>
                                                </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$highestDegreeMarksheet;?>','<?=$editdata['user_id'];?>','highestDegreeMarksheet-1','highest_degree_marksheet',<?=$editdata['nominee_detail_id']?>);">X</button>
                                        </div>  
                                    <?php endif; endif;?> 

                                    <div class="highestDegreeMarksheetWrapper" id="highestDegreeMarksheetWrapper">
                                      
                                    </div> 
                                  </div>                    
                              </div>  
                  </div>       

                              <div class="clearfix"></div>
                              <div class="form-group uploadseciz">
                                 <div class="mb-3 form-items">
                                    <label class="form-label">Research Experience (including, summer research, hands-on research workshop, etc.)
                                         
                                     </label>
                                    <button type="button" name="fellowship_research_experience_add" id="add_more_fellowship_research_experience" onclick="addMoreRows('researchExperienceWrapper','fellowship_research_experience','fellowship_research_experience');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>

                                    <?php if(is_array($researchExperience)): 
                                      for($i=0; $i<count($researchExperience); $i++): if(!empty($researchExperience[$i])): ?>
                                      <div class="mb-3 form-items" id="fellowship_research_experience<?=$i;?>">
                                          <input class="form-control mb-3 required fellowship_research_experience" accept=".pdf" name="fellowship_research_experience[<?=$researchExperience[$i];?>]" type="file">
                                        
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$researchExperience[$i];?>" target="_blank" title="<?=$researchExperience[$i];?>">
                                                <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                  <?=$researchExperience[$i];?>
                                              </button>
                                          </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$researchExperience[$i];?>','<?=$editdata['user_id'];?>','fellowship_research_experience<?=$i;?>','fellowship_research_experience',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>   
                                    <?php endif; endfor; 
                                        else: 
                                          if(!empty($researchExperience)): ?>                   
                                        <div class="mb-3 form-items" id="fellowship_research_experience-1">
                                          
                                          <input class="form-control mb-3 required fellowship_research_experience" accept=".pdf" name="fellowship_research_experience[<?=$researchExperience;?>]" type="file">
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$researchExperience;?>" target="_blank" title="<?=$researchExperience;?>">
                                            <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                <?=$researchExperience;?>
                                                </button>
                                                </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$researchExperience;?>','<?=$editdata['user_id'];?>','fellowship_research_experience-1','fellowship_research_experience',<?=$editdata['nominee_detail_id']?>);">X</button>
                                        </div>  
                                    <?php endif; endif;?> 

                                    <div class="researchExperienceWrapper" id="researchExperienceWrapper">
                                       
                                    </div> 
                                   
                                  </div>                    
                              </div>  

                        <div class="clearfix"></div>
                        <div class="form-group uploadseciz">
                                 <div class="mb-3 form-items">
                                      <label class="form-label" for="">Research publications, if any, with complete details (title, journal name, volume number, pages, year, and/or other relevant information)
                                     </label>
                                    <button type="button" name="fellowship_research_publications_add" id="add_more_fellowship_research_publications" onclick="addMoreRows('researchPublicationsWrapper','fellowship_research_publications','fellowship_research_publications');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>

                                    <?php if(is_array($researchPublications)): 
                                      for($i=0; $i<count($researchPublications); $i++): if(!empty($researchPublications[$i])): ?>
                                      <div class="mb-3 form-items" id="researchPublications<?=$i;?>">
                                          <input class="form-control mb-3 required fellowship_research_publications" accept=".pdf" name="fellowship_research_publications[<?=$researchPublications[$i];?>]" type="file">
                                        
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$researchPublications[$i];?>" target="_blank" title="<?=$researchPublications[$i];?>">
                                                <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                  <?=$researchPublications[$i];?>
                                              </button>
                                          </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$researchPublications[$i];?>','<?=$editdata['user_id'];?>','researchPublications<?=$i;?>','fellowship_research_publications',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>   
                                    <?php endif; endfor; 
                                        else: 
                                          if(!empty($researchPublications)): ?>
                                        <div class="mb-3 form-items" id="researchPublications-1">
                                          
                                          <input class="form-control mb-3 required fellowship_research_publications" accept=".pdf" name="fellowship_research_publications[<?=$researchPublications;?>]" type="file">
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$researchPublications;?>" target="_blank" title="<?=$researchPublications;?>">
                                            <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                <?=$researchPublications;?>
                                                </button>
                                                </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$researchPublications;?>','<?=$editdata['user_id'];?>','researchPublications-1','fellowship_research_publications',<?=$editdata['nominee_detail_id']?>);">X</button>
                                        </div>  
                                    <?php endif; endif;?> 

                                    <div class="researchPublicationsWrapper" id="researchPublicationsWrapper">
                                      
                                    </div> 
                                    
                                  </div>                    
                              </div>  

                            <div class="clearfix"></div>
                        <div class="form-group uploadseciz">
                                 <div class="mb-3 form-items">
                                      <label class="form-label" for="">Awards and Recognitions (such as, Young Scientist Award of a science or a medical academy or a national association of the applicant’s specialty)
                                     </label>
                                    <button type="button" name="fellowship_research_awards_and_recognitions_add" id="add_more_fellowship_research_awards_and_recognitions" onclick="addMoreRows('awardsRecognitionsWrapper','fellowship_research_awards_and_recognitions','fellowship_research_awards_and_recognitions');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>

                                    <?php if(is_array($awardsRecognitions)): 
                                      for($i=0; $i<count($awardsRecognitions); $i++): if(!empty($awardsRecognitions[$i])): ?>
                                      <div class="mb-3 form-items" id="fellowship_research_awards_and_recognitions<?=$i;?>">
                                          <input class="form-control mb-3 required fellowship_research_awards_and_recognitions" accept=".pdf" name="fellowship_research_awards_and_recognitions[<?=$awardsRecognitions[$i];?>]" type="file">
                                        
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$awardsRecognitions[$i];?>" target="_blank" title="<?=$awardsRecognitions[$i];?>">
                                                <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                  <?=$awardsRecognitions[$i];?>
                                              </button>
                                          </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$awardsRecognitions[$i];?>','<?=$editdata['user_id'];?>','fellowship_research_awards_and_recognitions<?=$i;?>','fellowship_research_awards_and_recognitions',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>   
                                    <?php endif; endfor; 
                                        else: 
                                          if(!empty($awardsRecognitions)): ?>
                                        <div class="mb-3 form-items" id="fellowship_research_awards_and_recognitions-1">
                                          
                                          <input class="form-control mb-3 required fellowship_research_awards_and_recognitions" accept=".pdf" name="fellowship_research_awards_and_recognitions[<?=$awardsRecognitions;?>]" type="file">
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$awardsRecognitions;?>" target="_blank" title="<?=$awardsRecognitions;?>">
                                            <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                <?=$awardsRecognitions;?>
                                                </button>
                                                </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$awardsRecognitions;?>','<?=$editdata['user_id'];?>','fellowship_research_awards_and_recognitions-1','fellowship_research_awards_and_recognitions',<?=$editdata['nominee_detail_id']?>);">X</button>
                                        </div>  
                                    <?php endif; endif;?> 
                                    <div class="awardsRecognitionsWrapper" id="awardsRecognitionsWrapper">
                                    
                                    </div> 
                                    
                                  </div>                    
                              </div>  

                              <div class="clearfix"></div>
                              <div class="form-group uploadseciz">
                                 <div class="mb-3 form-items">
                                      <label class="form-label" for="">Description of past scientific research projects completed and research experience (1 page)
                                     </label>
                                    <button type="button" name="fellowship_scientific_research_projects_add" id="add_more_fellowship_scientific_research_projects" onclick="addMoreRows('scientificResearchProjectsWrapper','fellowship_scientific_research_projects','fellowship_scientific_research_projects');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>
                                    <?php if(is_array($scientificResearchProjects)): 
                                      for($i=0; $i<count($scientificResearchProjects); $i++): if(!empty($scientificResearchProjects[$i])): ?>
                                      <div class="mb-3 form-items" id="fellowship_scientific_research_projects<?=$i;?>">
                                          <input class="form-control mb-3 required fellowship_scientific_research_projects" accept=".pdf" name="fellowship_scientific_research_projects[<?=$scientificResearchProjects[$i];?>]" type="file">
                                        
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$scientificResearchProjects[$i];?>" target="_blank" title="<?=$scientificResearchProjects[$i];?>">
                                                <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                  <?=$scientificResearchProjects[$i];?>
                                              </button>
                                          </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$scientificResearchProjects[$i];?>','<?=$editdata['user_id'];?>','fellowship_scientific_research_projects<?=$i;?>','fellowship_scientific_research_projects',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>   
                                    <?php endif; endfor; 
                                        else: 
                                          if(!empty($scientificResearchProjects)): ?>
                                        <div class="mb-3 form-items" id="fellowship_scientific_research_projects-1">
                                          
                                          <input class="form-control mb-3 required fellowship_scientific_research_projects" accept=".pdf" name="fellowship_scientific_research_projects[<?=$scientificResearchProjects;?>]" type="file">
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$scientificResearchProjects;?>" target="_blank" title="<?=$scientificResearchProjects;?>">
                                            <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                <?=$scientificResearchProjects;?>
                                                </button>
                                                </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$scientificResearchProjects;?>','<?=$editdata['user_id'];?>','fellowship_scientific_research_projects-1','fellowship_scientific_research_projects',<?=$editdata['nominee_detail_id']?>);">X</button>
                                        </div>  
                                    <?php endif; endif;?> 
                                      <div class="scientificResearchProjectsWrapper" id="scientificResearchProjectsWrapper">
                                      </div> 
                                    
                                  </div>                    
                              </div>  
                              <div class="clearfix"></div>
                              <div class="form-group uploadseciz">
                                 <div class="mb-3 form-items">
                                    <label class="form-label">Name of the institution in which research work on the <i>Sun Pharma Science Foundation Clinical Research Fellowship</i> will be carried out, if awarded:   
                                      <!-- <span class="required" style="color:red;">*</span> -->
                                    </label>
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                           <input id="fellowship_name_of_institution_research_work" class="form-control col-md-7 col-xs-12" type="text" name="fellowship_name_of_institution_research_work" value="<?php echo set_value('fellowship_name_of_institution_research_work',$editdata['fellowship_name_of_institution_research_work']);?>">
                                      </div>
                                  </div>                    
                              </div>         
                              <div class="clearfix"></div>
                              <div class="form-group uploadseciz">
                                 <div class="mb-3 form-items">
                                    <label class="form-label">If awarded, supervisor under whom research work on the <i>Sun Pharma Science Foundation Clinical Research Fellowship</i> will be carried out:   
                                      <!-- <span class="required" style="color:red;">*</span> -->
                                    </label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                             <label class="form-label">Name of supervisor:</label>
                                             <input id="fellowship_name_of_the_supervisor" class="form-control col-md-7 col-xs-12" type="text" name="fellowship_name_of_the_supervisor" value="<?php echo set_value('fellowship_name_of_the_supervisor',$editdata['fellowship_name_of_the_supervisor']);?>">
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                              <label class="form-label">Institution:</label>
                                              <input id="fellowship_name_of_institution" class="form-control col-md-7 col-xs-12" type="text" name="fellowship_name_of_institution" value="<?php echo set_value('fellowship_name_of_institution',$editdata['fellowship_name_of_institution']);?>">
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <label class="form-label">Department:</label>
                                            <input id="fellowship_supervisor_department" class="form-control col-md-7 col-xs-12" type="text" name="fellowship_supervisor_department" value="<?php echo set_value('fellowship_supervisor_department',$editdata['fellowship_supervisor_department']);?>">
                                        </div>
                                  </div>                    
                              </div>        
                              <div class="clearfix"></div>
                               <div class="form-group uploadseciz">
                                 <div class="mb-3 form-items">
                                    <label class="form-label">Description of research to be carried out if the <i>Sun Pharma Science Foundation Clinical Research Fellowship</i> is awarded (2 pages), comprising the following sections: (a) Introduction, (b) Objectives, (c) Brief description of pilot data, if available, (d) Methodology, (e) Anticipated outcomes, (f) Timelines
                                     </label>
                                    <button type="button" name="fellowship_description_of_research_add" id="add_more_fellowship_description_of_research" onclick="addMoreRows('descriptionOfResearchWrapper','fellowship_description_of_research','fellowship_description_of_research');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>
                                    <?php if(is_array($descriptionOfResearch)): 
                                      for($i=0; $i<count($descriptionOfResearch); $i++): if(!empty($descriptionOfResearch[$i])): ?>
                                      <div class="mb-3 form-items" id="fellowship_description_of_research<?=$i;?>">
                                          <input class="form-control mb-3 required fellowship_description_of_research" accept=".pdf" name="fellowship_description_of_research[<?=$descriptionOfResearch[$i];?>]" type="file">
                                        
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$descriptionOfResearch[$i];?>" target="_blank" title="<?=$descriptionOfResearch[$i];?>">
                                                <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                  <?=$descriptionOfResearch[$i];?>
                                              </button>
                                          </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$descriptionOfResearch[$i];?>','<?=$editdata['user_id'];?>','fellowship_description_of_research<?=$i;?>','fellowship_description_of_research',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>   
                                    <?php endif; endfor; 
                                        else: 
                                          if(!empty($descriptionOfResearch)): ?>
                                        <div class="mb-3 form-items" id="fellowship_description_of_research-1">
                                          
                                          <input class="form-control mb-3 required fellowship_description_of_research" accept=".pdf" name="fellowship_description_of_research[<?=$descriptionOfResearch;?>]" type="file">
                                          <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$descriptionOfResearch;?>" target="_blank" title="<?=$descriptionOfResearch;?>">
                                            <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                <?=$descriptionOfResearch;?>
                                                </button>
                                                </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$descriptionOfResearch;?>','<?=$editdata['user_id'];?>','fellowship_description_of_research-1','fellowship_description_of_research',<?=$editdata['nominee_detail_id']?>);">X</button>
                                        </div>  
                                    <?php endif; endif;?> 
                                    <div class="descriptionOfResearchWrapper" id="descriptionOfResearchWrapper">
                                    </div> 
                                  </div>                    
                              </div>  
                          <div class="clearfix"></div>
                         <div class="ln_solid"></div>
                          <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                              
                              <a href="<?=base_url();?>/admin/editdata" class="btn btn-primary">CANCEL</a>
                                <input type="submit" class="btn btn-success" name="submit" value="SAVE">
                            </div>
                          </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

<style>

.form-horizontal.addformsec .form-group.uploadseciz{background:#fdfdfd;border:1px solid #d9d9d9;padding:8px 15px;display:flex;width: 100%;}

.form-horizontal.addformsec .form-group.uploadseciz label.form-label {
    display: flex;
}

.form-horizontal.addformsec .form-group.uploadseciz .form-control[type="file"] {
  margin-top: 15px;width: 60%;min-width: 200px;padding-bottom: 36px!important;
}

.form-horizontal.addformsec .form-group.uploadseciz .form-items > div {
}

.form-horizontal.addformsec .form-group.uploadseciz .form-items {
    width: 100%;
}

.form-horizontal.addformsec .form-group.uploadseciz .form-items > div a button {
    display: inline-block;
    min-width: 200px;
    background: #047cb2;
    border: 0px solid #047cb2;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 90%;
    margin-right: 0;
    color: #fff;
    text-align: left;
}

.form-horizontal.addformsec .form-group.uploadseciz .form-items > div button[name="remove"] {
    padding: 2px 10px;
    opacity: .5;
}

.form-horizontal.addformsec .form-group.uploadseciz .form-items .form-items {border-bottom: 1px solid #ddd;padding: 0px 10px 20px 0px;margin: 0;}

.form-horizontal.addformsec .form-group.uploadseciz .form-items > div button[name="remove"]:hover {
    opacity: 1;
}

.form-horizontal.addformsec .form-group.uploadseciz .form-items > div a button:hover {
    background: #015379;
    color: white;
}

.form-horizontal.addformsec .form-group.uploadseciz .form-items > div > div {
    border-bottom: 1px solid #ddd;
    padding-bottom: 23px;
}

.form-horizontal.addformsec .form-group.uploadseciz .form-items > div > div:last-child {
    border: 0;
}
.mt20 {
    margin-top: 20px;
}
</style>