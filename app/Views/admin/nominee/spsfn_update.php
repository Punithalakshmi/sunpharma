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

                      if(strpos($editdata['supervisor_certifying'],','))
                        $supervisorCertifying = explode(',',$editdata['supervisor_certifying']);
                      else
                        $supervisorCertifying = $editdata['supervisor_certifying'];  

                      if(strpos($editdata['complete_bio_data'],','))
                        $completeBiodata = explode(',',$editdata['complete_bio_data']);
                      else
                        $completeBiodata = $editdata['complete_bio_data'];  

                      if(strpos($editdata['excellence_research_work'],','))
                        $excellenceResearchWork = explode(',',$editdata['excellence_research_work']);
                      else
                        $excellenceResearchWork = $editdata['excellence_research_work']; 

                      if(strpos($editdata['lists_of_publications'],','))
                         $listsOfPublications = explode(',',$editdata['lists_of_publications']);
                      else
                         $listsOfPublications = $editdata['lists_of_publications']; 

                      if(strpos($editdata['statement_of_applicant'],','))
                         $statementOfApplicant = explode(',',$editdata['statement_of_applicant']);
                      else
                         $statementOfApplicant = $editdata['statement_of_applicant']; 

                      if(strpos($editdata['ethical_clearance'],','))
                         $ethicalClearance = explode(',',$editdata['ethical_clearance']);
                      else
                         $ethicalClearance = $editdata['ethical_clearance']; 

                      if(strpos($editdata['statement_of_duly_signed_by_nominee'],','))
                         $statementOfDulySigned = explode(',',$editdata['statement_of_duly_signed_by_nominee']);
                      else
                         $statementOfDulySigned = $editdata['statement_of_duly_signed_by_nominee']; 

                      if(strpos($editdata['aggregate_marks'],','))
                         $aggregateMarks = explode(',',$editdata['aggregate_marks']);
                      else
                         $aggregateMarks = $editdata['aggregate_marks'];  

                      if(strpos($editdata['age_proof'],','))
                         $ageProof = explode(',',$editdata['age_proof']);
                      else
                         $ageProof = $editdata['age_proof'];    

                      if(strpos($editdata['declaration_candidate'],','))
                         $declarationCandidate = explode(',',$editdata['declaration_candidate']);
                      else
                         $declarationCandidate = $editdata['declaration_candidate']; 

                      if(strpos($editdata['citation'],','))
                         $citation = explode(',',$editdata['citation']);
                      else
                         $citation = $editdata['citation']; 

			                
			$currentYear = $editdata['nomination_year'];
	                $fileUploadDir = base_url().'/uploads/'.$currentYear.'/SSA/'.$editdata['user_id'];

                                ?>
                  <div class="x_content">
                    <br />
                    <form id="nomineeUpdate" enctype="multipart/form-data" action="<?php echo base_url();?>/admin/nominee/update/<?=$editdata['user_id'];?>" method="POST" data-parsley-validate class="form-horizontal form-label-left addformsec">
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
                              <img  src="<?=$fileUploadDir;?>/<?=$editdata['nominator_photo'];?>" width="50"
                              height="50" />
                              <br />
                      </div>
                      <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Category of the Fellowship<span class="required" style="color:red;">*</span></label>
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
                        <div class="form-group col-md-6"></div>
                        <div class="clearfix"></div>
                        <div class="form-group uploadseciz">
                                 <div class="mb-3 form-items">
                                  <label class="form-label">
                                      Letter from the supervisor certifying that the research work submitted for Sun Pharma Science Scholar Fellowship has actually been done by the applicant
                                  </label>
                                    <button type="button" name="supervisor_certifying_add" id="add_more_supervisor_certifying" onclick="addMoreRows('supervisorWrapper','supervisor_certifying','supervisor_certifying');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg>ADD
                                    </button>

                                    <?php if(is_array($supervisorCertifying)): 
                                            for($i=0; $i<count($supervisorCertifying); $i++): 
                                              if(!empty($supervisorCertifying[$i])): ?>
                                     <div class="mb-3 form-items" id="supervisorCertifying<?=$i;?>">
                                        <input class="form-control mb-3 required supervisor_certifying" accept=".pdf" name="supervisor_certifying[<?=$supervisorCertifying[$i];?>]" type="file">
                                       
                                         <a href="<?=$fileUploadDir;?>/<?=$supervisorCertifying[$i];?>" target="_blank" title="<?=$supervisorCertifying[$i];?>">
                                              <button class="btn btn-primary btn-sm" type="button">
                                                <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg>
                                                <?=$supervisorCertifying[$i];?>
                                              </button>
                                          </a>
                                        <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$supervisorCertifying[$i];?>','<?=$editdata['user_id'];?>','supervisorCertifying<?=$i;?>','supervisor_certifying',<?=$editdata['nominee_detail_id']?>);">X</button>
                                    </div>   
                                  <?php endif; endfor; 
                                      else:
                                        if(!empty($supervisorCertifying)): ?>
                                      <div class="mb-3 form-items" id="supervisorCertifying-1">
                                         
                                        <input class="form-control mb-3 required supervisor_certifying" accept=".pdf" name="supervisor_certifying[<?=$supervisorCertifying;?>]" type="file">
                                          <a href="<?=$fileUploadDir;?>/<?=$supervisorCertifying;?>" target="_blank" title="<?=$supervisorCertifying;?>">
                                            <button class="btn btn-primary btn-sm" type="button">
                                                <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg>
                                               <?=$supervisorCertifying;?>
                                               </button>
                                          </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$supervisorCertifying;?>','<?=$editdata['user_id'];?>','supervisorCertifying-1','supervisor_certifying',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>  
                                  <?php endif; endif;?>

                                    <div class="supervisorWrapper" id="supervisorWrapper">
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
                                       
                                         <a href="<?=$fileUploadDir;?>/<?=$completeBiodata[$i];?>" target="_blank" title="<?=$completeBiodata[$i];?>">
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
                                        <a href="<?=$fileUploadDir;?>/<?=$completeBiodata;?>" target="_blank" title="<?=$completeBiodata;?>">
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
                                    <label class="form-label"> Details of the excellence in research work for which the Sun Pharma Science Scholar Fellowship is claimed, including references and illustrations with following headings- Title, Introduction, Objectives, Materials and Methods, Results, Statistical Analysis, Discussion, Impact of the research in the advancement of knowledge or benefit to mankind, Literature reference. The candidate should duly sign on the details.(Max 2 MB) <span class="required" style="color:red;">*</span></label>
                                    <button type="button" name="excellence_research_work_add" id="add_more_excellence_research_work" onclick="addMoreRows('excellenceResearchWrapper','excellence_research_work','excellence_research_work');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>

                                    <?php if(is_array($excellenceResearchWork)): 
                                    for($i=0; $i<count($excellenceResearchWork); $i++): if(!empty($excellenceResearchWork[$i])): ?>
                                     <div class="mb-3 form-items" id="excellence_research_work<?=$i;?>">
                                        <input class="form-control mb-3 required excellence_research_work" accept=".pdf" name="excellence_research_work[<?=$excellenceResearchWork[$i];?>]" type="file">
                                       
                                         <a href="<?=$fileUploadDir;?>/<?=$excellenceResearchWork[$i];?>" target="_blank" title="<?=$excellenceResearchWork[$i];?>">
                                              <button class="btn btn-primary btn-sm" type="button">
                                                <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg>
                                                <?=$excellenceResearchWork[$i];?>
                                            </button>
                                        </a>
                                        <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$excellenceResearchWork[$i];?>','<?=$editdata['user_id'];?>','excellence_research_work<?=$i;?>','excellence_research_work',<?=$editdata['nominee_detail_id']?>);">X</button>
                                    </div>   
                                  <?php endif; endfor; 
                                      else: 
                                         if(!empty($excellenceResearchWork)): ?>
                                      <div class="mb-3 form-items" id="excellence_research_work-1">
                                         
                                        <input class="form-control mb-3 required excellence_research_work" accept=".pdf" name="excellence_research_work[<?=$excellenceResearchWork;?>]" type="file">
                                        <a href="<?=$fileUploadDir;?>/<?=$excellenceResearchWork;?>" target="_blank" title="<?=$excellenceResearchWork;?>">
                                          <button class="btn btn-primary btn-sm" type="button">
                                                <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg>
                                               <?=$excellenceResearchWork;?>
                                               </button>
                                              </a>
                                        <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$excellenceResearchWork;?>','<?=$editdata['user_id'];?>','excellence_research_work-1','excellence_research_work',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>  
                                  <?php endif; endif;?> 

                                    <div class="excellenceResearchWrapper" id="excellenceResearchWrapper">
                                      
                                    </div> 
                                   
                                  </div>                    
                              </div>  

                              <div class="clearfix"></div>
                              <div class="form-group uploadseciz">
                                 <div class="mb-3 form-items">
                                    <label class="form-label"> List of Publications, if any. If yes, Upload copies of any two publications (Max: 2 MB)
                                         
                                     </label>
                                    <button type="button" name="lists_of_publications_add" id="add_more_lists_of_publications" onclick="addMoreRows('listofPublicationsWrapper','lists_of_publications','lists_of_publications');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>

                                    <?php if(is_array($listsOfPublications)): 
                                      for($i=0; $i<count($listsOfPublications); $i++): if(!empty($listsOfPublications[$i])): ?>
                                      <div class="mb-3 form-items" id="lists_of_publications<?=$i;?>">
                                          <input class="form-control mb-3 required lists_of_publications" accept=".pdf" name="lists_of_publications[<?=$listsOfPublications[$i];?>]" type="file">
                                        
                                          <a href="<?=$fileUploadDir;?>/<?=$listsOfPublications[$i];?>" target="_blank" title="<?=$listsOfPublications[$i];?>">
                                                <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                  <?=$listsOfPublications[$i];?>
                                              </button>
                                          </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$listsOfPublications[$i];?>','<?=$editdata['user_id'];?>','lists_of_publications<?=$i;?>','lists_of_publications',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>   
                                    <?php endif; endfor; 
                                        else: 
                                          if(!empty($listsOfPublications)): ?>
                                        <div class="mb-3 form-items" id="lists_of_publications-1">
                                          
                                          <input class="form-control mb-3 required lists_of_publications" accept=".pdf" name="lists_of_publications[<?=$listsOfPublications;?>]" type="file">
                                          <a href="<?=$fileUploadDir;?>/<?=$listsOfPublications;?>" target="_blank" title="<?=$listsOfPublications;?>">
                                            <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                <?=$listsOfPublications;?>
                                                </button>
                                                </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$listsOfPublications;?>','<?=$editdata['user_id'];?>','lists_of_publications-1','lists_of_publications',<?=$editdata['nominee_detail_id']?>);">X</button>
                                        </div>  
                                    <?php endif; endif;?> 

                                    <div class="listofPublicationsWrapper" id="listofPublicationsWrapper">
                                       
                                    </div> 
                                   
                                  </div>                    
                              </div>  

                        <div class="clearfix"></div>
                        <div class="form-group uploadseciz">
                                 <div class="mb-3 form-items">
                                      <label class="form-label" for="">Statement of Merits/Fellowships/Scholarships already received by the Applicant (Max: 1 MB)
                                     </label>
                                    <button type="button" name="statement_of_applicant_add" id="add_more_statement_of_applicant" onclick="addMoreRows('statementOfApplicantWrapper','statement_of_applicant','statement_of_applicant');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>

                                    <?php if(is_array($statementOfApplicant)): 
                                      for($i=0; $i<count($statementOfApplicant); $i++): if(!empty($statementOfApplicant[$i])): ?>
                                      <div class="mb-3 form-items" id="statementOfApplicant<?=$i;?>">
                                          <input class="form-control mb-3 required statement_of_applicant" accept=".pdf" name="statement_of_applicant[<?=$statementOfApplicant[$i];?>]" type="file">
                                        
                                          <a href="<?=$fileUploadDir;?>/<?=$statementOfApplicant[$i];?>" target="_blank" title="<?=$statementOfApplicant[$i];?>">
                                                <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                  <?=$statementOfApplicant[$i];?>
                                              </button>
                                          </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$statementOfApplicant[$i];?>','<?=$editdata['user_id'];?>','statementOfApplicant<?=$i;?>','statement_of_applicant',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>   
                                    <?php endif; endfor; 
                                        else: 
                                          if(!empty($statementOfApplicant)): ?>
                                        <div class="mb-3 form-items" id="statementOfApplicant-1">
                                          
                                          <input class="form-control mb-3 required statement_of_applicant" accept=".pdf" name="statement_of_applicant[<?=$statementOfApplicant;?>]" type="file">
                                          <a href="<?=$fileUploadDir;?>/<?=$statementOfApplicant;?>" target="_blank" title="<?=$statementOfApplicant;?>">
                                            <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                <?=$statementOfApplicant;?>
                                                </button>
                                                </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$statementOfApplicant;?>','<?=$editdata['user_id'];?>','statementOfApplicant-1','statement_of_applicant',<?=$editdata['nominee_detail_id']?>);">X</button>
                                        </div>  
                                    <?php endif; endif;?> 

                                    <div class="statementOfApplicantWrapper" id="statementOfApplicantWrapper">
                                      
                                    </div> 
                                    
                                  </div>                    
                              </div>  

                            <div class="clearfix"></div>
                        <div class="form-group uploadseciz">
                                 <div class="mb-3 form-items">
                                      <label class="form-label" for="">A letter stating that the project submitted for the fellowship has received “ethical clearance” (Max: 250KB)
                                     </label>
                                    <button type="button" name="ethical_clearance_add" id="add_more_ethical_clearance" onclick="addMoreRows('ethicalClearanceWrapper','ethical_clearance','ethical_clearance');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>

                                    <?php if(is_array($ethicalClearance)): 
                                      for($i=0; $i<count($ethicalClearance); $i++): if(!empty($ethicalClearance[$i])): ?>
                                      <div class="mb-3 form-items" id="ethical_clearance<?=$i;?>">
                                          <input class="form-control mb-3 required ethical_clearance" accept=".pdf" name="ethical_clearance[<?=$ethicalClearance[$i];?>]" type="file">
                                        
                                          <a href="<?=$fileUploadDir;?>/<?=$ethicalClearance[$i];?>" target="_blank" title="<?=$ethicalClearance[$i];?>">
                                                <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                  <?=$ethicalClearance[$i];?>
                                              </button>
                                          </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$ethicalClearance[$i];?>','<?=$editdata['user_id'];?>','ethical_clearance<?=$i;?>','ethical_clearance',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>   
                                    <?php endif; endfor; 
                                        else: 
                                          if(!empty($ethicalClearance)): ?>
                                        <div class="mb-3 form-items" id="ethical_clearance-1">
                                          
                                          <input class="form-control mb-3 required ethical_clearance" accept=".pdf" name="ethical_clearance[<?=$ethicalClearance;?>]" type="file">
                                          <a href="<?=$fileUploadDir;?>/<?=$ethicalClearance;?>" target="_blank" title="<?=$ethicalClearance;?>">
                                            <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                <?=$ethicalClearance;?>
                                                </button>
                                                </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$ethicalClearance;?>','<?=$editdata['user_id'];?>','ethical_clearance-1','ethical_clearance',<?=$editdata['nominee_detail_id']?>);">X</button>
                                        </div>  
                                    <?php endif; endif;?> 
                                    <div class="ethicalClearanceWrapper" id="ethicalClearanceWrapper">
                                    
                                    </div> 
                                    
                                  </div>                    
                              </div>  

                              <div class="clearfix"></div>
                              <div class="form-group uploadseciz">
                                 <div class="mb-3 form-items">
                                      <label class="form-label" for=""> A statement duly signed by the nominee and the supervisor/co-author that academically or financially the thesis submitted for Sun Pharma Science Scholar Fellowship-<?=date("Y");?> has “non-conflict of interest” with the supervisor or co-authors (Max: 250KB)
                                     </label>
                                    <button type="button" name="statement_of_duly_signed_by_nominee_add" id="add_more_statement_of_duly_signed_by_nominee" onclick="addMoreRows('statementOfDulySignedWrapper','statement_of_duly_signed_by_nominee','statement_of_duly_signed_by_nominee');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>
                                    <?php if(is_array($statementOfDulySigned)): 
                                      for($i=0; $i<count($statementOfDulySigned); $i++): if(!empty($statementOfDulySigned[$i])): ?>
                                      <div class="mb-3 form-items" id="statement_of_duly_signed_by_nominee<?=$i;?>">
                                          <input class="form-control mb-3 required statement_of_duly_signed_by_nominee" accept=".pdf" name="statement_of_duly_signed_by_nominee[<?=$statementOfDulySigned[$i];?>]" type="file">
                                        
                                          <a href="<?=$fileUploadDir;?>/<?=$statementOfDulySigned[$i];?>" target="_blank" title="<?=$statementOfDulySigned[$i];?>">
                                                <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                  <?=$statementOfDulySigned[$i];?>
                                              </button>
                                          </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$statementOfDulySigned[$i];?>','<?=$editdata['user_id'];?>','statement_of_duly_signed_by_nominee<?=$i;?>','statement_of_duly_signed_by_nominee',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>   
                                    <?php endif; endfor; 
                                        else: 
                                          if(!empty($statementOfDulySigned)): ?>
                                        <div class="mb-3 form-items" id="statement_of_duly_signed_by_nominee-1">
                                          
                                          <input class="form-control mb-3 required statement_of_duly_signed_by_nominee" accept=".pdf" name="statement_of_duly_signed_by_nominee[<?=$statementOfDulySigned;?>]" type="file">
                                          <a href="<?=$fileUploadDir;?>/<?=$statementOfDulySigned;?>" target="_blank" title="<?=$statementOfDulySigned;?>">
                                            <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                <?=$statementOfDulySigned;?>
                                                </button>
                                                </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$statementOfDulySigned;?>','<?=$editdata['user_id'];?>','statement_of_duly_signed_by_nominee-1','statement_of_duly_signed_by_nominee',<?=$editdata['nominee_detail_id']?>);">X</button>
                                        </div>  
                                    <?php endif; endif;?> 
                                      <div class="statementOfDulySignedWrapper" id="statementOfDulySignedWrapper">
                                      </div>
                                  </div>                    
                              </div>  

                              <div class="clearfix"></div>
                        <div class="form-group uploadseciz">
                                 <div class="mb-3 form-items">
                                      <label class="form-label" for=""> Citation (brief summary) on the Research Work of the Applicant duly signed by the Nominator (Max: 300 KB)
                                     </label>
                                    <button type="button" name="citation_add" id="add_more_citation" onclick="addMoreRows('citationWrapper','citation','citation');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>
                                    <?php if(is_array($citation)): 
                                      for($i=0; $i<count($citation); $i++): if(!empty($citation[$i])): ?>
                                      <div class="mb-3 form-items" id="citation<?=$i;?>">
                                          <input class="form-control mb-3 required citation" accept=".pdf" name="complete_bio_data[<?=$citation[$i];?>]" type="file">
                                        
                                          <a href="<?=$fileUploadDir;?>/<?=$citation[$i];?>" target="_blank" title="<?=$citation[$i];?>">
                                                <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                  <?=$citation[$i];?>
                                              </button>
                                          </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$citation[$i];?>','<?=$editdata['user_id'];?>','citation<?=$i;?>','citation',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>   
                                    <?php endif; endfor; 
                                        else: 
                                          if(!empty($citation)): ?>
                                        <div class="mb-3 form-items" id="citation-1">
                                          
                                          <input class="form-control mb-3 required citation" accept=".pdf" name="citation[<?=$citation;?>]" type="file">
                                          <a href="<?=$fileUploadDir;?>/<?=$citation;?>" target="_blank" title="<?=$citation;?>">
                                            <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                <?=$citation;?>
                                                </button>
                                                </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$citation;?>','<?=$editdata['user_id'];?>','citation-1','citation',<?=$editdata['nominee_detail_id']?>);">X</button>
                                        </div>  
                                    <?php endif; endif;?> 
                                    <div class="citationWrapper" id="citationWrapper">
                                       
                                    </div> 
                                    
                                  </div>                    
                              </div>  

                              <div class="clearfix"></div>
                        <div class="form-group uploadseciz">
                                 <div class="mb-3 form-items">
                                      <label class="form-label" for=""> Aggregate marks obtained in PCB/PCM in Class XII or any other course (Max: 250 KB)
                                     </label>
                                    <button type="button" name="aggregate_marks_add" id="add_more_aggregate_marks" onclick="addMoreRows('aggregateMarksWrapper','aggregate_marks','aggregate_marks');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>
                                    <?php if(is_array($aggregateMarks)): 
                                      for($i=0; $i<count($aggregateMarks); $i++): if(!empty($aggregateMarks[$i])): ?>
                                      <div class="mb-3 form-items" id="aggregate_marks<?=$i;?>">
                                          <input class="form-control mb-3 required aggregate_marks" accept=".pdf" name="aggregate_marks[<?=$aggregateMarks[$i];?>]" type="file">
                                        
                                          <a href="<?=$fileUploadDir;?>/<?=$aggregateMarks[$i];?>" target="_blank" title="<?=$aggregateMarks[$i];?>">
                                                <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                  <?=$aggregateMarks[$i];?>
                                              </button>
                                          </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$aggregateMarks[$i];?>','<?=$editdata['user_id'];?>','aggregate_marks<?=$i;?>','aggregate_marks',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>   
                                    <?php endif; endfor; 
                                        else: 
                                          if(!empty($aggregateMarks)): ?>
                                        <div class="mb-3 form-items" id="aggregate_marks-1">
                                          
                                          <input class="form-control mb-3 required aggregate_marks" accept=".pdf" name="aggregate_marks[<?=$aggregateMarks;?>]" type="file">
                                          <a href="<?=$fileUploadDir;?>/<?=$aggregateMarks;?>" target="_blank" title="<?=$aggregateMarks;?>">
                                            <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                <?=$aggregateMarks;?>
                                                </button>
                                                </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$aggregateMarks;?>','<?=$editdata['user_id'];?>','aggregate_marks-1','aggregate_marks',<?=$editdata['nominee_detail_id']?>);">X</button>
                                        </div>  
                                    <?php endif; endif;?> 
                                    <div class="aggregateMarksWrapper" id="aggregateMarksWrapper">
                                       
                                    </div> 
                                    
                                  </div>                    
                              </div>  

                              <div class="clearfix"></div>
                        <div class="form-group uploadseciz">
                                 <div class="mb-3 form-items">
                                      <label class="form-label" for=""> Age proof (Max: 250KB)
                                     </label>
                                    <button type="button" name="age_proof_add" id="add_more_age_proof" onclick="addMoreRows('ageProofWrapper','age_proof','age_proof');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>
                                    <?php if(is_array($ageProof)): 
                                      for($i=0; $i<count($ageProof); $i++): if(!empty($ageProof[$i])): ?>
                                      <div class="mb-3 form-items" id="ageProof<?=$i;?>">
                                          <input class="form-control mb-3 required age_proof" accept=".pdf" name="age_proof[<?=$ageProof[$i];?>]" type="file">
                                        
                                          <a href="<?=$fileUploadDir;?>/<?=$ageProof[$i];?>" target="_blank" title="<?=$ageProof[$i];?>">
                                                <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                  <?=$ageProof[$i];?>
                                              </button>
                                          </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$ageProof[$i];?>','<?=$editdata['user_id'];?>','ageProof<?=$i;?>','age_proof',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>   
                                    <?php endif; endfor; 
                                        else: 
                                          if(!empty($ageProof)): ?>
                                        <div class="mb-3 form-items" id="ageProof-1">
                                          
                                          <input class="form-control mb-3 required age_proof" accept=".pdf" name="age_proof[<?=$ageProof;?>]" type="file">
                                          <a href="<?=$fileUploadDir;?>/<?=$ageProof;?>" target="_blank" title="<?=$ageProof;?>">
                                            <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                <?=$ageProof;?>
                                                </button>
                                                </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$ageProof;?>','<?=$editdata['user_id'];?>','ageProof-1','age_proof',<?=$editdata['nominee_detail_id']?>);">X</button>
                                        </div>  
                                    <?php endif; endif;?> 
                                    <div class="ageProofWrapper" id="ageProofWrapper">
                                      
                                    </div> 
                                    
                                  </div>                    
                              </div>  

                              <div class="clearfix"></div>
                         <div class="form-group uploadseciz">
                                 <div class="mb-3 form-items">
                                    <label class="form-label" for=""> A voluntary declaration from the candidate that they would work in the public or private funded academic/research based organizations for a minimum period of two years after completion of his/her studies. (Max: 250KB)
                                     </label>
                                    <button type="button" name="declaration_candidate_add" id="add_more_declaration_candidate" onclick="addMoreRows('declarationWrapper','declaration_candidate','declaration_candidate');" class="btn btn-primary btn-sm">
                                      <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                      </svg> ADD
                                    </button>
                                    <?php if(is_array($declarationCandidate)): 
                                      for($i=0; $i<count($declarationCandidate); $i++): if(!empty($declarationCandidate[$i])): ?>
                                      <div class="mb-3 form-items" id="declaration_candidate<?=$i;?>">
                                          <input class="form-control mb-3 required declaration_candidate" accept=".pdf" name="declaration_candidate[<?=$declarationCandidate[$i];?>]" type="file">
                                        
                                          <a href="<?=$fileUploadDir;?>/<?=$declarationCandidate[$i];?>" target="_blank" title="<?=$declarationCandidate[$i];?>">
                                                <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                  <?=$declarationCandidate[$i];?>
                                              </button>
                                          </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$declarationCandidate[$i];?>','<?=$editdata['user_id'];?>','declaration_candidate<?=$i;?>','declaration_candidate',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>   
                                    <?php endif; endfor; 
                                        else: 
                                          if(!empty($declarationCandidate)): ?>
                                        <div class="mb-3 form-items" id="declarationCandidate-1">
                                          
                                          <input class="form-control mb-3 required declaration_candidate" accept=".pdf" name="declaration_candidate[<?=$declarationCandidate;?>]" type="file">
                                          <a href="<?=$fileUploadDir;?>/<?=$declarationCandidate;?>" target="_blank" title="<?=$declarationCandidate;?>">
                                            <button class="btn btn-primary btn-sm" type="button">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg>
                                                <?=$declarationCandidate;?>
                                                </button>
                                                </a>
                                          <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$declarationCandidate;?>','<?=$editdata['user_id'];?>','declarationCandidate-1','declaration_candidate',<?=$editdata['nominee_detail_id']?>);">X</button>
                                        </div>  
                                    <?php endif; endif;?> 
                                    <div class="declarationWrapper" id="declarationWrapper">
                                      
                                    </div> 
                                   
                                  </div>                    
                              </div>  
                         <div class="clearfix"></div>
                             
                         <div class="ln_solid"></div>
                          <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                              
                              <a href="<?=base_url();?>/admin/nominee/view/<?=$editdata['user_id'];?>" class="btn btn-primary">CANCEL</a>
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