<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Update Nominee</h3>
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

                          if(strpos($editdata['passport_filename'],','))
                             $passport = explode(',',$editdata['passport_filename']);
                          else
                             $passport = $editdata['passport_filename'];  

                          if(strpos($editdata['complete_bio_data'],','))
                             $completeBiodata = explode(',',$editdata['complete_bio_data']);
                          else
                             $completeBiodata = $editdata['complete_bio_data'];  

                          if(strpos($editdata['best_papers'],','))
                             $bestPapers = explode(',',$editdata['best_papers']);
                          else
                             $bestPapers = $editdata['best_papers']; 

                          if(strpos($editdata['statement_of_research_achievements'],','))
                              $researchAchievements = explode(',',$editdata['statement_of_research_achievements']);
                          else
                               $researchAchievements = $editdata['statement_of_research_achievements']; 

                          if(strpos($editdata['signed_details'],','))
                               $signedDetails = explode(',',$editdata['signed_details']);
                          else
                               $signedDetails = $editdata['signed_details']; 

                          if(strpos($editdata['specific_publications'],','))
                               $specificPublicaions = explode(',',$editdata['specific_publications']);
                          else
                               $specificPublicaions = $editdata['specific_publications']; 

                          if(strpos($editdata['signed_statement'],','))
                               $signedStatement = explode(',',$editdata['signed_statement']);
                          else
                               $signedStatement = $editdata['signed_statement']; 

                          // echo $editdata['citation']; die;  
                          if(strpos($editdata['citation'],','))
                              $citation = explode(',',$editdata['citation']);
                          else
                              $citation = $editdata['citation']; 

                  ?>
                  <div class="x_content">
                    <br />
                    <form id="nomineeUpdate" action="<?php echo base_url();?>/admin/nominee/update/<?=$editdata['user_id'];?>" method="POST" data-parsley-validate class="form-horizontal form-label-left addformsec" enctype="multipart/form-data">
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
                              <img  src="<?=base_url();?>/frontend/assets/img/editdata--default-Image.png" width="50"
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
                      <?php if(isset($validation) && $validation->getError('firstname')) {?>
                          <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('firstname'); ?>
                          </div>
                      <?php }?>
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
                      <?php if(isset($validation) && $validation->getError('email')) {?>
                        <div class='alert alert-danger mt-2'>
                          <?= $error = $validation->getError('email'); ?>
                            </div>
                        <?php } ?>
                      </div>
                    
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth 
                              <span class="required" style="color:red;">*</span> 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12"> 
                          <input id="single_cal3" name="date_of_birth" class="date-picker form-control col-md-7 col-xs-12" type="text" value="<?php echo set_value('date_of_birth',date("m/d/Y",strtotime($editdata['dob'])));?>">
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
                      <?php if(isset($validation) && $validation->getError('mobile_no')) {?>
                        <div class='alert alert-danger mt-2'>
                          <?= $error = $validation->getError('mobile_no'); ?>
                            </div>
                        <?php }?>
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
                      <?php if(isset($validation) && $validation->getError('designation_and_office_address')) {?>
                        <div class='alert alert-danger mt-2'>
                          <?= $error = $validation->getError('designation_and_office_address'); ?>
                            </div>
                        <?php }?>
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
                            <small class="text-danger">
                                <?php if(isset($validation) && $validation->getError('citizenship')) {?>
                                    <?= $error = $validation->getError('citizenship'); ?>
                                <?php }?>
                            </small>
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
                      <?php if(isset($validation) && $validation->getError('residence_address')) {?>
                        <div class='alert alert-danger mt-2'>
                          <?= $error = $validation->getError('residence_address'); ?>
                            </div>
                        <?php }?>
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
                      <?php if(isset($validation) && $validation->getError('nominator_name')) {?>
                        <div class='alert alert-danger mt-2'>
                          <?= $error = $validation->getError('nominator_name'); ?>
                            </div>
                        <?php }?>
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
                      <?php if(isset($validation) && $validation->getError('nominator_mobile')) {?>
                        <div class='alert alert-danger mt-2'>
                          <?= $error = $validation->getError('nominator_mobile'); ?>
                            </div>
                        <?php }?>
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
                      <?php if(isset($validation) && $validation->getError('nominator_email')) {?>
                        <div class='alert alert-danger mt-2'>
                          <?= $error = $validation->getError('nominator_email'); ?>
                            </div>
                        <?php }?>
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
                      <?php if(isset($validation) && $validation->getError('nominator_designation')) {?>
                        <div class='alert alert-danger mt-2'>
                          <?= $error = $validation->getError('nominator_designation'); ?>
                            </div>
                        <?php }?>
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
                      <?php if(isset($validation) && $validation->getError('nominator_address')) {?>
                        <div class='alert alert-danger mt-2'>
                          <?= $error = $validation->getError('nominator_address'); ?>
                            </div>
                        <?php }?>
                      </div>
                        <div class="clearfix"></div>
                        <?php
                        
                          $justificationLtr = base_url()."/uploads/".$editdata['user_id']."/".$editdata['justification_letter_filename'];

                        ?>
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
                            <label class="form-label " for=""> Passport </label>

                               <button type="button" name="passport_add" id="add_more_passport" onclick="addMoreRows('passportWrapper','passport','passport');" class="btn btn-primary btn-sm add_more_passport">
                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                  </svg> ADD
                                </button>

                                <?php if(is_array($passport)): 
                                    for($i=0; $i<count($passport); $i++): if(!empty($passport[$i])):?>
                                     <div class="mb-3 form-items" id="passport<?=$i;?>">
                                        <input class="form-control mb-3 required passport" accept=".pdf" name="passport[]"  type="file">
                                       
                                         <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$passport[$i];?>" target="_blank" title="<?=$passport[$i];?>">
                                              <button class="btn btn-primary btn-sm" type="button">
                                                <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg>
                                                <?=$passport[$i];?>
                                            </button>
                                        </a>
                                        <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$passport[$i];?>','<?=$editdata['user_id'];?>','passport<?=$i;?>','passport_filename',<?=$editdata['nominee_detail_id']?>);">X</button>
                                    </div>   
                                  <?php endif; endfor; 
                                      else:  
                                        if(!empty($passport)): ?>
                                      <div class="mb-3 form-items" id="passport-1">
                                         
                                        <input class="form-control mb-3 required passport" accept=".pdf" name="passport[]" type="file">
                                        <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$passport;?>" target="_blank" title="<?=$passport;?>">
                                          <button class="btn btn-primary btn-sm" type="button">
                                                <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg>
                                               <?=$passport;?>
                                               </button>
                                              </a>
                                        <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$passport;?>','<?=$editdata['user_id'];?>','passport-1','passport_filename',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>  
                                  <?php endif; endif;?> 


                              <div class="passportWrapper" id="passportWrapper">
                                  
                              </div>
                               
                        </div>
                      </div>
                        <div class="clearfix"></div>
                        <div class="form-group uploadseciz">
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


                              <div class="bioDataWrapper" id="bioDataWrapper">
                                
                              </div>
                           
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group uploadseciz">
                        <div class="mb-3 form-items">
                            <label class="form-label"> In order of Importance, list of 10
                                best papers of the applicant highlighting the important
                                discoveries/contributions described in them briefly (Max. 1 MB) <span class="required" style="color:red;">*</span>
                                <div class="">
                                            <small>Upload the List of Publication (Not more than 1 MB) </small>
                                        </div>
                              </label>

                              <button type="button" name="best_pappers_add" id="add_more_best_papers" onclick="addMoreRows('bestPapersWrapper','best_papers','best_papers');" class="btn btn-primary btn-sm">
                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                  </svg> ADD
                                </button>

                                <?php if(is_array($bestPapers)): 
                                    for($i=0; $i<count($bestPapers); $i++): if(!empty($bestPapers[$i])):?>
                                     <div class="mb-3 form-items" id="best_papers_<?=$i;?>">
                                        <input class="form-control mb-3 required complete_bio_data" accept=".pdf" name="best_papers[<?=$bestPapers[$i];?>]" type="file">
                                       
                                         <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$bestPapers[$i];?>" target="_blank" title="<?=$bestPapers[$i];?>">
                                              <button class="btn btn-primary btn-sm" type="button">
                                                <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg>
                                                <?=$bestPapers[$i];?>
                                            </button>
                                        </a>
                                        <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$bestPapers[$i];?>','<?=$editdata['user_id'];?>','best_papers_<?=$i;?>','best_papers',<?=$editdata['nominee_detail_id']?>);">X</button>
                                    </div>   
                                  <?php endif; endfor; 
                                      else:
                                        if(!empty($bestPapers)): ?>
                                      <div class="mb-3 form-items" id="best_papers-1">
                                         
                                        <input class="form-control mb-3 required complete_bio_data" accept=".pdf" name="best_papers[<?=$bestPapers;?>]" type="file">
                                        <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$bestPapers;?>" target="_blank" title="<?=$bestPapers;?>">
                                          <button class="btn btn-primary btn-sm" type="button">
                                                <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg>
                                               <?=$bestPapers;?>
                                               </button>
                                              </a>
                                        <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$bestPapers;?>','<?=$editdata['user_id'];?>','best_papers-1','best_papers',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      <div>  
                                  <?php endif; endif;?> 

                                <div class="bestPapersWrapper" id="bestPapersWrapper">
                                        
                                   <!-- <input class="form-control mb-3 required best_papers" accept=".pdf" name="best_papers[]" type="file" id="best_papers" value="<?//$editdata['best_papers'];?>">  
                                                -->
                                </div>
                                
                                
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group uploadseciz">
                                    <div class="mb-3 form-items">
                                        <label class="form-label"> Statement of Research Achievements, if
                                            any, on which any Award has already been Received by the Applicant. Please
                                            also upload brief citations on the research works for which the applicant
                                            has already received the awards (Max. 1 MB) 
                                            <span class="required" style="color:red;">*</span>
                                            <div>
                                                <small>Upload the list of awards already received by the applicant
                                                    (Not more than 1MB)
                                                </small>
                                            </div>
                                          </label>
                                          <button type="button" name="statement_of_research_achievements_add" id="add_more_statement_of_research_achievements" onclick="addMoreRows('statementResearchWrapper','statement_of_research_achievements','statement_of_research_achievements');" class="btn btn-primary btn-sm">
                                            <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                              <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> ADD
                                          </button>
                                           
                                               
                                            
                                            <?php if(is_array($researchAchievements)): 
                                              for($i=0; $i<count($researchAchievements); $i++): if(!empty($researchAchievements[$i])): ?>
                                              <div class="mb-3 form-items" id="researchAchievements<?=$i;?>">
                                                  <input class="form-control mb-3 required statement_of_research_achievements" accept=".pdf" name="statement_of_research_achievements[<?=$researchAchievements[$i];?>]" type="file">
                                                
                                                  <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$researchAchievements[$i];?>" target="_blank" title="<?=$researchAchievements[$i];?>">
                                                        <button class="btn btn-primary btn-sm" type="button">
                                                          <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                              <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                          </svg>
                                                          <?=$researchAchievements[$i];?>
                                                      </button>
                                                  </a>
                                                  <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$researchAchievements[$i];?>','<?=$editdata['user_id'];?>','researchAchievements<?=$i;?>','statement_of_research_achievements',<?=$editdata['nominee_detail_id']?>);">X</button>
                                              </div>   
                                            <?php endif; endfor; 
                                                else:
                                                  if(!empty($researchAchievements)): ?>
                                                <div class="mb-3 form-items" id="researchAchievements-1">
                                                  
                                                  <input class="form-control mb-3 required statement_of_research_achievements" accept=".pdf" name="statement_of_research_achievements[<?=$researchAchievements;?>]" type="file">
                                                  <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$researchAchievements;?>" target="_blank" title="<?=$researchAchievements;?>">
                                                    <button class="btn btn-primary btn-sm" type="button">
                                                          <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                              <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                          </svg>
                                                        <?=$researchAchievements;?>
                                                        </button>
                                                        </a>
                                                  <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$researchAchievements;?>','<?=$editdata['user_id'];?>','researchAchievements-1','statement_of_research_achievements',<?=$editdata['nominee_detail_id']?>);">X</button>
                                                </div>  
                                            <?php endif; endif;?> 

                                            <div class="statementResearchWrapper" id="statementResearchWrapper">
                                                   
                                            </div>
                                    </div>
                                </div>
                        <div class="clearfix"></div>
                        <div class="form-group uploadseciz">
                            <div class="mb-3 form-items">
                                    <label class="form-label " for=""> Signed details of the excellence in
                                        research work for which the Sun Pharma Research Award is claimed, including
                                        references & illustra- tions (Max. 2.5 MB). The candidate should duly sign
                                        on the details <span class="required" style="color:red;">*</span>
                                        <div class="">
                                        <small>Upload the details of the research work for which nomination
                                            is being sent(Not more than 2.5 MB)</small>
                                      </div>
                                    </label>
                                    <button type="button" name="signed_details_add" id="add_more_signed_details" onclick="addMoreRows('signedDetailsWrapper','signed_details','signed_details');" class="btn btn-primary btn-sm">
                                            <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                              <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> ADD
                                          </button>
                                    
                                
                                    <?php if(is_array($signedDetails)): 
                                    for($i=0; $i<count($signedDetails); $i++): if(!empty($signedDetails[$i])):?>
                                     <div class="mb-3 form-items" id="signedDetails<?=$i;?>">
                                        <input class="form-control mb-3 required signed_details" accept=".pdf" name="signed_details[<?=$signedDetails[$i];?>]" type="file">
                                       
                                         <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$signedDetails[$i];?>" target="_blank" title="<?=$signedDetails[$i];?>">
                                              <button class="btn btn-primary btn-sm" type="button">
                                                <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg>
                                                <?=$signedDetails[$i];?>
                                            </button>
                                        </a>
                                        <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$signedDetails[$i];?>','<?=$editdata['user_id'];?>','signedDetails<?=$i;?>','signed_details',<?=$editdata['nominee_detail_id']?>);">X</button>
                                    </div>   
                                  <?php endif; endfor; 
                                      else:
                                        if(!empty($signedDetails)): ?>
                                      <div class="mb-3 form-items" id="signedDetails-1">
                                         
                                        <input class="form-control mb-3 required signed_details" accept=".pdf" name="signed_details[<?=$signedDetails;?>]" type="file">
                                        <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$signedDetails;?>" target="_blank" title="<?=$signedDetails;?>">
                                          <button class="btn btn-primary btn-sm" type="button">
                                                <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg>
                                               <?=$signedDetails;?>
                                               </button>
                                              </a>
                                        <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$signedDetails;?>','<?=$editdata['user_id'];?>','signedDetails-1','signed_details',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>  
                                  <?php endif; endif;?> 
                                  <div class="signedDetailsWrapper" id="signedDetailsWrapper">
                                       
                                    </div>
                              </div>
                       </div>
                        <div class="clearfix"></div>
                        <div class="form-group uploadseciz">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> Two specific publications/research
                                            papers of the applicant relevant to the research work mentioned above (Max.
                                            2.5 MB) <span class="required" style="color:red;">*</span>
                                            <div class="">
                                                    <small>Upload the publication/Research paper (Not more than 2.5 MB)</small>
                                                </div>
                                        </label>
                                          <button type="button" name="specific_publications_add" id="add_more_specific_publications" onclick="addMoreRows('publicationsWrapper','specific_publications','specific_publications');" class="btn btn-primary btn-sm">
                                            <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                              <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> ADD
                                          </button>
                                             
                                           
                                        <?php if(is_array($specificPublicaions)): 
                                    for($i=0; $i<count($specificPublicaions); $i++): if(!empty($specificPublicaions[$i])):?>
                                     <div class="mb-3 form-items" id="specificPublicaions<?=$i;?>">
                                        <input class="form-control mb-3 required complete_bio_data" accept=".pdf" name="specific_publications[<?=$specificPublicaions[$i];?>]" type="file">
                                       
                                         <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$specificPublicaions[$i];?>" target="_blank" title="<?=$specificPublicaions[$i];?>">
                                              <button class="btn btn-primary btn-sm" type="button">
                                                <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg>
                                                <?=$specificPublicaions[$i];?>
                                            </button>
                                        </a>
                                        <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$specificPublicaions[$i];?>','<?=$editdata['user_id'];?>','specificPublicaions<?=$i;?>','specific_publications',<?=$editdata['nominee_detail_id']?>);">X</button>
                                    </div>   
                                  <?php endif; endfor; 
                                      else:
                                      if(!empty($specificPublicaions)): ?>
                                      <div class="mb-3 form-items" id="specificPublicaions-1">
                                         
                                        <input class="form-control mb-3 required complete_bio_data" accept=".pdf" name="specific_publications[<?=$specificPublicaions;?>]" type="file">
                                        <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$specificPublicaions;?>" target="_blank" title="<?=$specificPublicaions;?>">
                                          <button class="btn btn-primary btn-sm" type="button">
                                                <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg>
                                               <?=$specificPublicaions;?>
                                               </button>
                                              </a>
                                        <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$specificPublicaions;?>','<?=$editdata['user_id'];?>','specificPublicaions-1','specific_publications',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>  
                                  <?php endif; endif;?> 

                                       <div class="publicationsWrapper" id="publicationsWrapper">
                                         
                                        </div>
                                      </div>
                                      </div>
                                  <div class="clearfix"></div>
                                  <div class="form-group uploadseciz">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> A signed statement by the applicant
                                            that the research work under reference has not been given any award. The
                                            applicant should also indicate the extent of the contribution of others
                                            associated with the research and he/she should clearly acknowledge his/her
                                            achievements. (Max. 500 KB) <span class="required" style="color:red;">*</span></label>
                                              
                                                <div>
                                                    <small>Upload the signed statement (Not more than 500 KB) </small>
                                                </div>
                                                <button type="button" name="signed_statement_add" id="add_more_signed_statement" onclick="addMoreRows('signedStatementWrapper','signed_statement','signed_statement');" class="btn btn-primary btn-sm">
                                                  <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                  </svg> ADD
                                                </button>
                                             
                                           
                                              <?php if(is_array($signedStatement)): 
                                    for($i=0; $i<count($signedStatement); $i++): if(!empty($signedStatement[$i])): ?>
                                     <div class="mb-3 form-items" id="signedStatement<?=$i;?>">
                                        <input class="form-control mb-3 required signed_statement" accept=".pdf" name="signed_statement[<?=$signedStatement[$i];?>]" type="file">
                                       
                                         <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$signedStatement[$i];?>" target="_blank" title="<?=$signedStatement[$i];?>">
                                              <button class="btn btn-primary btn-sm" type="button">
                                                <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg>
                                                <?=$signedStatement[$i];?>
                                            </button>
                                        </a>
                                        <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$signedStatement[$i];?>','<?=$editdata['user_id'];?>','signedStatement<?=$i;?>','signed_statement',<?=$editdata['nominee_detail_id']?>);">X</button>
                                    </div>   
                                  <?php endif; endfor; 
                                      else:
                                      if(!empty($signedStatement)): ?>
                                      <div class="mb-3 form-items" id="signedStatement-1">
                                         
                                        <input class="form-control mb-3 required signed_statement" accept=".pdf" name="signed_statement[<?=$signedStatement;?>]" type="file">
                                        <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$signedStatement;?>" target="_blank" title="<?=$signedStatement;?>">
                                          <button class="btn btn-primary btn-sm" type="button">
                                                <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                </svg>
                                               <?=$signedStatement;?>
                                               </button>
                                              </a>
                                        <button type="button" name="remove"  class="btn btn-danger btn_remove" onclick="removeFile('<?=$signedStatement;?>','<?=$editdata['user_id'];?>','signedStatement-1','signed_statement',<?=$editdata['nominee_detail_id']?>);">X</button>
                                      </div>  
                                  <?php endif; endif;?> 
                                  <div class="signedStatementWrapper" id="signedStatementWrapper">                                           
                                                
                                              </div>
                                    </div>
                                </div>                       
                              <div class="clearfix"></div>
                              <div class="form-group uploadseciz">
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
                                       <!-- <input class="form-control mb-3 required citation" accept=".pdf" name="citation[]" type="file" id="citation" value="<?//$editdata['citation'];?>">    -->
                                    </div> 
                                    <?php if(is_array($citation)): 
                                    for($i=0; $i<count($citation); $i++): if(!empty($citation[$i])):  ?>
                                     <div class="mb-3 form-items" id="citation<?=$i;?>">
                                        <input class="form-control mb-3 required citation" accept=".pdf" name="citation[<?=$citation[$i];?>]" type="file">
                                       
                                         <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$citation[$i];?>" target="_blank" title="<?=$citation[$i];?>">
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
                                         
                                        <input class="form-control mb-3 required complete_bio_data" accept=".pdf" name="citation[<?=$citation;?>]" type="file">
                                        <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$citation;?>" target="_blank" title="<?=$citation;?>">
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