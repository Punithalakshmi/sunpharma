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
                
                  <div class="x_content">
                    <br />
                    <form id="nomineeUpdate" action="<?php echo base_url();?>/admin/nominee/update/<?=$editdata['user_id'];?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                      <input type="hidden" name="id" value="<?=$editdata['id'];?>"  >
                      <?= csrf_field(); ?>
                      <div class="form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                
                                      Photograph of the Applicant 
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
                        <?php }?>
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
                        <div class="form-group">
                        <div class="mb-3 form-items">
                            <label class="form-label"> Justification for Sponsoring the
                                Nomination duly signed by the Nominator (not to exceed 400 words) </label>
                                <div >
                                    <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$editdata['justification_letter_filename'];?>" target="_blank">
                                        <button class="btn btn-primary btn-sm" type="button">
                                        <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                        </svg> View
                                        </button>
                                    </a>
                                </div>
                        </div>
                      </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                        <div class="mb-3 form-items">
                            <label class="form-label " for=""> Passport </label>
                                <div>
                                    <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$editdata['passport_filename'];?>" target="_blank" >
                                        <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                        </svg> View
                                        </button>
                                    </a>
                                </div>
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
                            <button class="btn btn-primary btn-sm add_more_bio_data" type="button">
                                   <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                      <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                    </svg> ADD
                                  </button>
                            <div class="bioDataWrapper">
                                <input class="form-control mb-3 required" accept=".pdf" name="complete_bio_data" type="file" id="complete_bio_data" value="<?=$editdata['complete_bio_data'];?>">   
                            </div>
                            <small class="text-danger">
                            <?php if(isset($validation) && $validation->getError('complete_bio_data')) {?>
                                <?= $error = $validation->getError('complete_bio_data'); ?>
                            <?php }?>
                            </small>
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
                            <label class="form-label"> In order of Importance, list of 10
                                best papers of the applicant highlighting the important
                                discoveries/contributions described in them briefly (Max. 1 MB) <span class="required" style="color:red;">*</span>
                                <div class="">
                                            <small>Upload the List of Publication (Not more than 1 MB) </small>
                                        </div>
                              </label>
                                <div class="bestPapersWrapper">
                                        
                                   <input class="form-control mb-3 required" accept=".pdf" name="best_papers" type="file" id="best_papers" value="<?=$editdata['best_papers'];?>">  
                                       
                                        
                                </div>
                                <small class="text-danger">
                                <?php if(isset($validation) && $validation->getError('best_papers')) {?>
                                    <?= $error = $validation->getError('best_papers'); ?>
                                <?php }?>
                                </small>
                                <?php if(!empty($editdata['best_papers'])): ?>
                                <div>
                                <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$editdata['best_papers'];?>" target="_blank">
                                    <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                    <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                </svg> View</button>
                                    </a>
                                </div>
                                <?php endif;?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
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
                                          <div class="statementResearchWrapper">
                                                  <input class="form-control mb-3 required" accept=".pdf" name="statement_of_research_achievements" type="file" id="statement_of_research_achievements" value="<?=$editdata['statement_of_research_achievements'];?>">      
                                          </div>
                                               
                                            
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('statement_of_research_achievements')) {?>
                                                <?= $error = $validation->getError('statement_of_research_achievements'); ?>
                                            <?php }?>
                                            </small>
                                            <?php if(!empty($editdata['statement_of_research_achievements'])): ?>
                                            <div>
                                            <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$editdata['statement_of_research_achievements'];?>" target="_blank">
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
                                    <label class="form-label " for=""> Signed details of the excellence in
                                        research work for which the Sun Pharma Research Award is claimed, including
                                        references & illustra- tions (Max. 2.5 MB). The candidate should duly sign
                                        on the details <span class="required" style="color:red;">*</span>
                                        <div class="">
                                        <small>Upload the details of the research work for which nomination
                                            is being sent(Not more than 2.5 MB)</small>
                                      </div>
                                    </label>
                                    <div class="signedDetailsWrapper">
                                        <input class="form-control mb-3 required" accept=".pdf" name="signed_details" type="file" id="signed_details" value="<?=$editdata['signed_details'];?>">                    
                                    </div>
                                   
                                <small class="text-danger">
                                <?php if(isset($validation) && $validation->getError('signed_details')) {?>
                                    <?= $error = $validation->getError('signed_details'); ?>
                                <?php }?>
                                </small>
                                    <?php if(!empty($editdata['signed_details'])): ?>
                                    <div>
                                        <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$editdata['signed_details'];?>" target="_blank">
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
                                        <label class="form-label " for=""> Two specific publications/research
                                            papers of the applicant relevant to the research work mentioned above (Max.
                                            2.5 MB) <span class="required" style="color:red;">*</span>
                                            <div class="">
                                                    <small>Upload the publication/Research paper (Not more than 2.5 MB)</small>
                                                </div>
                                        </label>
                                        <div class="publicationsWrapper">
                                          <input class="form-control mb-3 required" accept=".pdf" name="specific_publications" type="file" id="specific_publications" value="<?=$editdata['specific_publications'];?>">  
                                        </div>
                                                
                                           
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('specific_publications')) {?>
                                                <?= $error = $validation->getError('specific_publications'); ?>
                                            <?php }?>
                                            </small>
                                            <?php if(!empty($editdata['specific_publications'])): ?>
                                            <div>
                                            <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$editdata['specific_publications'];?>" target="_blank">
                                              <button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View</button>
                                                </a>
                                            </div>
                                            <?php endif;?>
                                            </div>
                                </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> A signed statement by the applicant
                                            that the research work under reference has not been given any award. The
                                            applicant should also indicate the extent of the contribution of others
                                            associated with the research and he/she should clearly acknowledge his/her
                                            achievements. (Max. 500 KB) <span class="required" style="color:red;">*</span></label>
                                                <div>
                                                    <small>Upload the signed statement (Not more than 500 KB) </small>
                                                </div>
                                            <div class="signedStatement">                                           
                                                <input class="form-control mb-3 required" accept=".pdf" name="signed_statement" type="file" id="signed_statement" value="<?=$editdata['signed_statement'];?>">   
                                            </div>
                                            <small class="text-danger">
                                            <?php if(isset($validation) && $validation->getError('signed_statement')) {?>
                                                <?= $error = $validation->getError('signed_statement'); ?>
                                            <?php }?>
                                            </small>
                                            <?php if(!empty($editdata['signed_statement'])): ?>
                                            <div>
                                            <a href="<?=base_url();?>/uploads/<?=$editdata['user_id'];?>/<?=$editdata['signed_statement'];?>" target="_blank">
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
                                <div class="">
                                    <small>Upload the Citation (Not more than 300KB) </small>
                                </div>
                              </label>
                                 
                                <div class="citationWrapper">
                        
                                  <input class="form-control mb-3 required" accept=".pdf" name="citation" type="file" id="citation" value="<?=$editdata['citation'];?>">   
                                  </div> 
                                  <small class="text-danger">
                                  <?php if(isset($validation) && $validation->getError('citation')) {?>
                                      <?= $error = $validation->getError('citation'); ?>
                                  <?php }?>
                                  </small>
                    
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
                            
                            <a href="<?=base_url();?>/admin/nominee/view/<?=$editdata['user_id'];?>" class="btn btn-primary">CANCEL</a>
                            <input type="submit" class="btn btn-success" name="submit" value="SAVE">
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
