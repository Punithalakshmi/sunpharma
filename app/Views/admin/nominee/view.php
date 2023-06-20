<style>.product-image.border.avatarimg {
    min-height: 150px;
    background: rgb(250 250 250 / 28%);
}</style>

<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Nominee Details</h3>
              </div>
              <div class="title_right">
               
                <h3>Total Score: <span class="badge badge-warning">
                  <i class="fa fa-star"></i> <?=($average_rating>0)?round($average_rating):0;?></span></h3>
                <?php if(isset($user['status']) && $user['status'] == 'Approved' ): ?>
                  <h3 class="approvedtxt"><span class="badge badge-success">
                    <i class="fa fa-check-circle"></i> Approved</span>
                </h3>
                <?php else: ?>
                  <h3 class="disapprovedtxt"><span class="badge badge-info"><i class="fa fa-times-circle"></i> Pending </span></h3>
                  <?php endif; ?>

                 <?php if(isset($userdata['role']) && ( $userdata['role'] == 1)): ?>
                <a class="btn btn-primary" href="<?=base_url();?>/jury/nominations">
                 <i class="fa fa-arrow-left"></i>BACK
                </a>
               <?php else: ?>
                <a class="btn btn-primary" href="<?=base_url();?>/admin/nominee">
                 <i class="fa fa-arrow-left"></i>BACK
                </a>
                <?php endif;?> 

              </div>
             
            </div>
            <div class="clearfix"></div>
            <?= csrf_field(); ?>
            <div class="clearfix"></div>
            <?php if(session()->getFlashdata('msg')):?>
              <div class="alert alert-warning">
                  <?= session()->getFlashdata('msg') ?>
              </div>
            <?php endif;?>
          

            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel xpanelform">
              <div class="x_content">

                <div class="col-md-3 col-xs-12 mt-30">
                  <div class="product-image border avatarimg">
                    <img class="border" src="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['nominator_photo'];?>" alt="" style="border: 1px solid #959595;padding: 5px;"> 
                  </div>
                  <div class="product_gallery">
                  
                  </div>
                </div>

          <div class="col-md-8 col-xs-12" style="border:0px solid #e5e5e5;">

            <h3 class="prod_title d-flex" style="justify-content: space-between;"><?=$user['firstname'].' '.$user['lastname'];?>
            <?php if($userdata['role'] == 3): ?>
                <a class="btn btn-primary btn-sm" href="<?=base_url();?>/admin/nominee/update/<?=$user['user_id'];?>">
                   EDIT
                </a>
            <?php endif;?>    
             </h3>
            <div class="form-group row formitem">
              <label class="col-sm-3 col-form-label">Nomination NO</label>
              <div class="col-sm-9">
                  <?=$user['registration_no'];?>
              </div>
          </div> 
            <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">Award Type</label>
                <div class="col-sm-9"><?=$user['category_name'];?></div>
              </div>

              <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                <?=$user['email'];?>  </div>
              </div>

              <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">Phonenumber</label>
                <div class="col-sm-9">
                <?=$user['phone'];?>  </div>
              </div>
                    
              <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-9">
                <?=$user['address'];?>  </div>
              </div>

              <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">Nominator Name</label>
                <div class="col-sm-9">
                <?=$user['nominator_name'];?></div>
              </div>

              <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">Nominator Phone</label>
                <div class="col-sm-9">
                <?=$user['nominator_phone'];?>  </div>
              </div>

              <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">Nominator Email</label>
                <div class="col-sm-9">
                <?=$user['nominator_email'];?>  </div>
              </div>
                        
              <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">Nominator Address</label>
                <div class="col-sm-9">
                <?=$user['nominator_address'];?> </div>
              </div>
            <?php if(isset($user['nomination_type']) && ($user['nomination_type'] == 'fellowship')){ ?>
              <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">First Employment:</label>
                <div class="col-sm-3">
                  <label class="col-form-label">Name of institution and location:</label> 
                  <?=$user['first_employment_name_of_institution_location'];?> 
                </div>
                <div class="col-sm-3">
                  <label class="col-form-label">Designation/post:</label> 
                  <?=$user['first_employment_designation'];?> 
                </div>
                <div class="col-sm-3">
                  <label class="col-form-label">Year of joining:</label> 
                  <?=$user['first_employment_year_of_joining'];?> 
                </div>
              </div>

              <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">First medical degree obtained: </label>
                <div class="col-sm-3">
                  <label class="col-form-label">Name of degree</label> 
                  <?=$user['first_medical_degree_name_of_degree'];?> 
                </div>
                <div class="col-sm-3">
                  <label class="col-form-label">Year of award of degree:</label> 
                  <?=$user['first_medical_degree_year_of_award'];?> 
                </div>
                <div class="col-sm-3">
                  <label class="col-form-label">Institution awarding the degree</label> 
                  <?=$user['first_medical_degree_institution'];?> 
                </div>
                <div class="col-sm-3">
                  <label class="col-form-label">Marksheet</label> 
                  <?=$user['first_degree_marksheet'];?> 
                </div>
              </div>

              <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">Highest medical degree obtained: </label>
                <div class="col-sm-3">
                  <label class="col-sm-3 col-form-label">Name of degree</label> 
                  <?=$user['highest_medical_degree_name'];?> 
                </div>
                <div class="col-sm-3">
                  <label class="col-sm-3 col-form-label">Year of award of degree:</label> 
                  <?=$user['highest_medical_degree_year'];?> 
                </div>
                <div class="col-sm-3">
                  <label class="col-sm-3 col-form-label">Institution awarding the degree</label> 
                  <?=$user['highest_medical_degree_institution'];?> 
                </div>
                <div class="col-sm-3">
                  <label class="col-sm-3 col-form-label">Marksheet</label> 
                  <?=$user['highest_degree_marksheet'];?> 
                </div>
              </div>

              <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">Name of the institution in which research work on the Sun Pharma Science Foundation Clinical Research Fellowship will be carried out, if awarded:</label>
                <div class="col-sm-9">
                <?=$user['fellowship_name_of_institution_research_work'];?> </div>
              </div>

              <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">If awarded, supervisor under whom research work on the Sun Pharma Science Foundation Clinical Research Fellowship will be carried out: </label>
                <div class="col-sm-3">
                  <label class="col-sm-3 col-form-label">Name of supervisor</label> 
                  <?=$user['fellowship_name_of_the_supervisor'];?> 
                </div>
                <div class="col-sm-3">
                  <label class="col-sm-3 col-form-label">Institution:</label> 
                  <?=$user['fellowship_name_of_institution'];?> 
                </div>
                <div class="col-sm-3">
                  <label class="col-sm-3 col-form-label">Department</label> 
                  <?=$user['fellowship_supervisor_department'];?> 
                </div>
              </div>

            <?php }?>
            <?php if(isset($user['nomination_type']) && ($user['nomination_type'] == 'ssan')){
              //$files split section
              if(strpos($user['justification_letter_filename'],','))
                $justificationLetter = explode(',',$user['justification_letter_filename']);
              else
                $justificationLetter = $user['justification_letter_filename'];
                
              if(strpos($user['passport_filename'],','))
                $passport = explode(',',$user['passport_filename']);
              else
                $passport = $user['passport_filename'];  

              if(strpos($user['complete_bio_data'],','))
                $completeBiodata = explode(',',$user['complete_bio_data']);
              else
                $completeBiodata = $user['complete_bio_data'];  

              if(strpos($user['best_papers'],','))
                $bestPapers = explode(',',$user['best_papers']);
              else
                $bestPapers = $user['best_papers']; 
                
              if(strpos($user['statement_of_research_achievements'],','))
                $researchAchievements = explode(',',$user['statement_of_research_achievements']);
              else
                $researchAchievements = $user['statement_of_research_achievements']; 

              if(strpos($user['signed_details'],','))
                $signedDetails = explode(',',$user['signed_details']);
              else
                $signedDetails = $user['signed_details']; 

              if(strpos($user['specific_publications'],','))
                $specificPublicaions = explode(',',$user['specific_publications']);
              else
                $specificPublicaions = $user['specific_publications']; 

              if(strpos($user['signed_statement'],','))
                $signedStatement = explode(',',$user['signed_statement']);
              else
                $signedStatement = $user['signed_statement']; 

             // echo $user['citation']; die;  
              if(strpos($user['citation'],','))
                $citation = explode(',',$user['citation']);
              else
                $citation = $user['citation']; 
              ?>
              <div class="form-group row formitem graybox">
                <label class="col-sm-3 col-form-label">Justification Letter</label>
                <div class="col-sm-9">
                      <?php if(is_array($justificationLetter)): 
                        for($i=0; $i<count($justificationLetter); $i++): ?>
                      <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$justificationLetter[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$justificationLetter[$i];?></a>
                      <?php endfor; 
                          else:?>
                        <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$justificationLetter;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$justificationLetter;?></a>
                      <?php endif;?> 
                   </div>
              </div>

              <div class="form-group row formitem graybox">
                <label class="col-sm-3 col-form-label">Passport</label>
                <div class="col-sm-9">
                <?php if(is_array($passport)): 
                        for($i=0; $i<count($passport); $i++): ?>
                  <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$passport[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$passport[$i];?></a> 
                  <?php endfor; 
                          else:?>
                           <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$passport;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$passport;?></a> 
                     <?php endif;?>      
                </div>
              </div>

             <?php if(!empty($user['complete_bio_data'])):?>
              <div class="form-group row formitem graybox">
                <label class="col-sm-3 col-form-label">Complete Bio-data of the applicant</label>
                <div class="col-sm-9">
                <?php if(is_array($completeBiodata)): 
                        for($i=0; $i<count($completeBiodata); $i++): ?>
                  <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$completeBiodata[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$completeBiodata[$i];?></a> 
                  <?php endfor; 
                          else:?>
                           <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$completeBiodata;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$completeBiodata;?></a>
                     <?php endif;?>       
                </div>
              </div>
             <?php endif;
              if(!empty($user['best_papers'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">In Order of Importance list of 10 best papers of the applicant highlighting the important discoveries/contribution described in them briefly.(Max 1 MB)</label>
                <div class="col-sm-9">
                <?php if(is_array($bestPapers)): 
                        for($i=0; $i<count($bestPapers); $i++): ?>
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$bestPapers[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$bestPapers[$i];?></a> 
                <?php endfor; 
                          else:?>
                    <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$bestPapers;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$bestPapers;?></a> 
                 <?php endif;?>
                </div>
              </div>

              <?php endif; if(!empty($user['statement_of_research_achievements'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Statement of Research Achievements, if any, on which any Award has already been Received by the Applicant. Please also upload brief citations on the research works for which the applicant has already received the awards</label>
                <div class="col-sm-9">
                <?php if(is_array($researchAchievements)): 
                        for($i=0; $i<count($researchAchievements); $i++): ?>
                 <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$researchAchievements[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$researchAchievements[$i];?></a> 
                 <?php endfor; 
                      else:?>
                        <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$researchAchievements;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$researchAchievements;?></a> 
                        <?php endif;?>
                </div>
              </div>
             
              <?php endif; if(!empty($user['signed_details'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Signed details of the excellence in research work for which the Sun Pharma Research Award is claimed, including references and illustrations. The candidate should duly sign on the details.</label>
                <div class="col-sm-9">
                <?php if(is_array($signedDetails)): 
                        for($i=0; $i<count($signedDetails ); $i++): ?>
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$signedDetails[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$signedDetails[$i];?></a> 
                <?php endfor; 
                      else:?>
                      <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$signedDetails;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$signedDetails;?></a> 
                      <?php endif;?>
                </div>
              </div>
              <?php endif; if(!empty($user['specific_publications'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Two specific publications/research papers of the applicant relevent to the research work mentioned above.(Max: 2.5MB)</label>
                <div class="col-sm-9">
                <?php if(is_array($specificPublicaions)): 
                        for($i=0; $i<count($specificPublicaions ); $i++): ?>
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$specificPublicaions[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$specificPublicaions[$i];?></a> 
                <?php endfor; 
                      else:?>
                      <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$specificPublicaions;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$specificPublicaions;?></a> 
                      <?php endif;?>
                </div>
              </div>
              <?php endif; if(!empty($user['signed_statement'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">A signed statement by the applicant that the research work under reference has not been given any award. The applicant should also indicate the extent of the contribution of the others associated with the research and he/she should clearly acknowledge his/her achievements (Max: 500KB)</label>
                <div class="col-sm-9">
                <?php if(is_array($signedStatement)): 
                        for($i=0; $i<count($signedStatement); $i++): ?>
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$signedStatement[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$signedStatement[$i];?></a> 
                <?php endfor; 
                      else:?>
                        <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$signedStatement;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$signedStatement;?></a>
                      <?php endif;?>
                </div>
              </div>
              <?php endif;  if(!empty($user['citation'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Citation on the Research Work of the Applicant duly signed by the Naminator(Max: 300 KB)</label>
                <div class="col-sm-9">
                <?php if(is_array($citation)): 
                        for($i=0; $i<count($citation); $i++): ?>
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$citation[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$citation[$i];?></a> 
                <?php endfor; 
                      else:?>
                      <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$citation;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$citation;?></a> 
                      <?php endif;?>
                </div>
              </div>
              <?php endif;
                   }
                    else if(isset($user['nomination_type']) && ($user['nomination_type'] == 'fellowship')){
                      if(strpos($user['justification_letter_filename'],','))
                        $justificationLetter = explode(',',$user['justification_letter_filename']);
                      else
                        $justificationLetter = $user['justification_letter_filename'];
      
                      if(strpos($user['fellowship_research_experience'],','))
                          $researchExperience = explode(',',$user['fellowship_research_experience']);
                      else
                          $researchExperience = $user['fellowship_research_experience'];  
      
                      if(strpos($user['complete_bio_data'],','))
                          $completeBiodata = explode(',',$user['complete_bio_data']);
                      else
                          $completeBiodata = $user['complete_bio_data'];  
      
                      if(strpos($user['fellowship_research_publications'],','))
                        $researchPublications = explode(',',$user['fellowship_research_publications']);
                      else
                        $researchPublications = $user['fellowship_research_publications']; 
      
                      if(strpos($user['fellowship_research_awards_and_recognitions'],','))
                        $awardsRecognitions = explode(',',$user['fellowship_research_awards_and_recognitions']);
                      else
                        $awardsRecognitions = $user['fellowship_research_awards_and_recognitions']; 
      
                      if(strpos($user['fellowship_scientific_research_projects'],','))
                        $scientificResearchProjects = explode(',',$user['fellowship_scientific_research_projects']);
                      else
                        $scientificResearchProjects = $user['fellowship_scientific_research_projects']; 

                      if(strpos($user['fellowship_description_of_research'],','))
                        $descriptionOfResearch = explode(',',$user['fellowship_description_of_research']);
                      else
                        $descriptionOfResearch = $user['fellowship_description_of_research'];   

                     
                        
                   ?>

                <?php if(!empty($user['justification_letter_filename'])):?>
                    <div class="form-group row formitem graybox">
                    <label class="col col-form-label nonecolan"> Attach Justification Letter in pdf format (for Sponsoring the Nomination duly signed by the Nominator, Max : 500 KB)</label>
                    <div class="col-sm-9">
                    <?php if(is_array($justificationLetter)): 
                            for($i=0; $i<count($justificationLetter); $i++): ?>
                          <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$justificationLetter[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$justificationLetter[$i];?></a>
                          <?php endfor; 
                              else:?>
                            <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$justificationLetter;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$justificationLetter;?></a>
                          <?php endif;?>
                  </div>
                  </div>
                  <?php endif; ?>

                  <?php if(!empty($user['complete_bio_data'])):?>
                  <div class="form-group row formitem graybox">
                    <label class="col col-form-label nonecolan">Complete Bio-data of the applicant(Max: 1MB) pdf format</label>
                    <div class="col-sm-9">
                    <?php if(is_array($completeBiodata)): 
                            for($i=0; $i<count($completeBiodata); $i++): ?>
                      <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$completeBiodata[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$completeBiodata[$i];?></a> 
                      <?php endfor; 
                              else:?>
                              <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$completeBiodata;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$completeBiodata;?></a>
                        <?php endif;?> 
                    </div>
                  </div>
                  <?php endif; ?>

                  <?php if(!empty($user['fellowship_research_experience'])):?>
                  <div class="form-group row formitem graybox">
                    <label class="col col-form-label nonecolan">Research Experience (including, summer research, hands-on research workshop, etc.)</label>
                    <div class="col-sm-9">
                    <?php if(is_array($researchExperience)): 
                            for($i=0; $i<count($researchExperience); $i++): ?>
                      <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$researchExperience[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$researchExperience[$i];?></a> 
                      <?php endfor; 
                              else:?>
                              <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$researchExperience;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$researchExperience;?></a>
                        <?php endif;?> 
                    </div>
                  </div>
                  <?php endif; ?>

                  <?php if(!empty($user['fellowship_research_publications'])):?>
                  <div class="form-group row formitem graybox">
                    <label class="col col-form-label nonecolan">Research publications, if any, with complete details (title, journal name, volume number, pages, year, and/or other relevant information)</label>
                    <div class="col-sm-9">
                    <?php if(is_array($researchPublications)): 
                            for($i=0; $i<count($researchPublications); $i++): ?>
                      <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$researchPublications[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$researchPublications[$i];?></a> 
                      <?php endfor; 
                              else:?>
                              <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$researchPublications;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$researchPublications;?></a>
                        <?php endif;?> 
                    </div>
                  </div>
                  <?php endif; ?>

                  <?php if(!empty($user['fellowship_research_awards_and_recognitions'])):?>
                  <div class="form-group row formitem graybox">
                    <label class="col col-form-label nonecolan">Awards and Recognitions (such as, Young Scientist Award of a science or a medical academy or a national association of the applicant’s specialty)</label>
                    <div class="col-sm-9">
                    <?php if(is_array($awardsRecognitions)): 
                            for($i=0; $i<count($awardsRecognitions); $i++): ?>
                      <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$awardsRecognitions[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$awardsRecognitions[$i];?></a> 
                      <?php endfor; 
                              else:?>
                              <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$awardsRecognitions;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$awardsRecognitions;?></a>
                        <?php endif;?> 
                    </div>
                  </div>
                  <?php endif; ?>

                  <?php if(!empty($user['fellowship_scientific_research_projects'])):?>
                  <div class="form-group row formitem graybox">
                    <label class="col col-form-label nonecolan">Description of past scientific research projects completed and research experience (1 page)</label>
                    <div class="col-sm-9">
                    <?php if(is_array($scientificResearchProjects)): 
                            for($i=0; $i<count($scientificResearchProjects); $i++): ?>
                      <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$scientificResearchProjects[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$scientificResearchProjects[$i];?></a> 
                      <?php endfor; 
                              else:?>
                              <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$scientificResearchProjects;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$scientificResearchProjects;?></a>
                        <?php endif;?> 
                    </div>
                  </div>
                  <?php endif; ?>

                  <?php if(!empty($user['fellowship_description_of_research'])):?>
                  <div class="form-group row formitem graybox">
                    <label class="col col-form-label nonecolan">Description of research to be carried out if the Sun Pharma Science Foundation Clinical Research Fellowship is awarded (2 pages), comprising the following sections: (a) Introduction, (b) Objectives, (c) Brief description of pilot data, if available, (d) Methodology, (e) Anticipated outcomes, (f) Timelines</label>
                    <div class="col-sm-9">
                    <?php if(is_array($descriptionOfResearch)): 
                            for($i=0; $i<count($descriptionOfResearch); $i++): ?>
                      <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$descriptionOfResearch[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$descriptionOfResearch[$i];?></a> 
                      <?php endfor; 
                              else:?>
                              <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$descriptionOfResearch;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$descriptionOfResearch;?></a>
                        <?php endif;?> 
                    </div>
                  </div>
                  <?php endif; ?>

                   <?php } else{
 
                  if(strpos($user['justification_letter_filename'],','))
                    $justificationLetter = explode(',',$user['justification_letter_filename']);
                  else
                    $justificationLetter = $user['justification_letter_filename'];

                  if(strpos($user['supervisor_certifying'],','))
                      $supervisorCertifying = explode(',',$user['supervisor_certifying']);
                  else
                      $supervisorCertifying = $user['supervisor_certifying'];  

                  if(strpos($user['complete_bio_data'],','))
                      $completeBiodata = explode(',',$user['complete_bio_data']);
                  else
                      $completeBiodata = $user['complete_bio_data'];  

                  if(strpos($user['excellence_research_work'],','))
                    $excellenceResearchWork = explode(',',$user['excellence_research_work']);
                  else
                    $excellenceResearchWork = $user['excellence_research_work']; 

                  if(strpos($user['lists_of_publications'],','))
                    $listsOfPublications = explode(',',$user['lists_of_publications']);
                  else
                    $listsOfPublications = $user['lists_of_publications']; 

                  if(strpos($user['statement_of_applicant'],','))
                    $statementOfApplicant = explode(',',$user['statement_of_applicant']);
                  else
                    $statementOfApplicant = $user['statement_of_applicant']; 

                  if(strpos($user['ethical_clearance'],','))
                    $ethicalClearance = explode(',',$user['ethical_clearance']);
                  else
                    $ethicalClearance  = $user['ethical_clearance']; 
                    
                  if(strpos($user['statement_of_duly_signed_by_nominee'],','))
                      $statementOfDulySigned = explode(',',$user['statement_of_duly_signed_by_nominee']);
                  else
                    $statementOfDulySigned  = $user['statement_of_duly_signed_by_nominee']; 

                if(strpos($user['aggregate_marks'],','))
                    $aggregateMarks = explode(',',$user['aggregate_marks']);
                else
                    $aggregateMarks  = $user['aggregate_marks'];  
                    
                  if(strpos($user['age_proof'],','))
                      $ageProof = explode(',',$user['age_proof']);
                  else
                      $ageProof  = $user['age_proof'];    

                  if(strpos($user['declaration_candidate'],','))
                    $declarationCandidate = explode(',',$user['declaration_candidate']);
                  else
                    $declarationCandidate = $user['declaration_candidate']; 

                  if(strpos($user['citation'],','))
                    $citation = explode(',',$user['citation']);
                  else
                    $citation = $user['citation']; 
                
                ?>
                <?php if(!empty($user['justification_letter_filename'])):?>
                <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan"> Attach Justification Letter in pdf format (for Sponsoring the Nomination duly signed by the Nominator, Max : 500 KB)</label>
                <div class="col-sm-9">
                <?php if(is_array($justificationLetter)): 
                        for($i=0; $i<count($justificationLetter); $i++): ?>
                      <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$justificationLetter[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$justificationLetter[$i];?></a>
                      <?php endfor; 
                          else:?>
                        <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$justificationLetter;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$justificationLetter;?></a>
                      <?php endif;?>
               </div>
              </div>
              <?php endif; if(!empty($user['supervisor_certifying'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Letter from the supervisor certifying that the research work submitted for Sun Pharma Science Scholar Award has actually been done by the applicant(500 KB)</label>
                <div class="col-sm-9">
                    <?php if(is_array($supervisorCertifying)): 
                        for($i=0; $i<count($supervisorCertifying); $i++): ?>
                      <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$supervisorCertifying[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$supervisorCertifying[$i];?></a>
                      <?php endfor; 
                          else:?>
                        <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$supervisorCertifying;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$supervisorCertifying;?></a>
                      <?php endif;?>
                </div>
              </div>
              <?php endif; if(!empty($user['complete_bio_data'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Complete Bio-data of the applicant(Max: 1MB) pdf format</label>
                <div class="col-sm-9">
                <?php if(is_array($completeBiodata)): 
                        for($i=0; $i<count($completeBiodata); $i++): ?>
                  <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$completeBiodata[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$completeBiodata[$i];?></a> 
                  <?php endfor; 
                          else:?>
                           <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$completeBiodata;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$completeBiodata;?></a>
                     <?php endif;?> 
                </div>
              </div>
              <?php endif; if(!empty($user['excellence_research_work'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Details of the excellence in research work for which the Sun Pharma Science Scholar Award is claimed, including references and illustrations with following headings- Title, Introduction, Objectives, Materials and Methods, Results, Statistical Analysis, Discussion, Impact of the research in the advancement of knowledge or benefit to mankind, Literature reference. The candidate should duly sign on the details.(Max 2 MB)</label>
                <div class="col-sm-9">
                  
                   <?php if(is_array($excellenceResearchWork)): 
                        for($i=0; $i<count($excellenceResearchWork); $i++): ?>
                      <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$excellenceResearchWork[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$excellenceResearchWork[$i];?></a>
                      <?php endfor; 
                          else:?>
                        <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$excellenceResearchWork;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$excellenceResearchWork;?></a>
                      <?php endif;?>
                </div>
              </div>
              <?php endif; if(!empty($user['lists_of_publications'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">List of Publications, if any. If yes, Upload copies of any two publications (Max: 2 MB)</label>
                <div class="col-sm-9">
                
                  <?php if(is_array($listsOfPublications)): 
                        for($i=0; $i<count($listsOfPublications); $i++): ?>
                      <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$listsOfPublications[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$listsOfPublications[$i];?></a>
                      <?php endfor; 
                          else:?>
                        <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$listsOfPublications;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$listsOfPublications;?></a>
                      <?php endif;?>
                </div>
              </div>


              <?php endif; if(!empty($user['statement_of_applicant'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Statement of Merits/Awards/Scholarships already received by the Applicant (Max: 1 MB)</label>
                <div class="col-sm-9">
               
                <?php if(is_array($statementOfApplicant)): 
                        for($i=0; $i<count($statementOfApplicant); $i++): ?>
                      <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$statementOfApplicant[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$statementOfApplicant[$i];?></a>
                      <?php endfor; 
                          else:?>
                        <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$statementOfApplicant;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$statementOfApplicant;?></a>
                      <?php endif;?>

                </div>
              </div>
              <?php endif; if(!empty($user['ethical_clearance'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">A letter stating that the project submitted for the award has received “ethical clearance” (Max: 250KB)</label>
                <div class="col-sm-9">
               
                <?php if(is_array($ethicalClearance)): 
                        for($i=0; $i<count($ethicalClearance); $i++): ?>
                      <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$ethicalClearance[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$ethicalClearance[$i];?></a>
                      <?php endfor; 
                          else:?>
                        <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$ethicalClearance;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$ethicalClearance;?></a>
                      <?php endif;?>

                </div>
              </div>
              <?php endif; if(!empty($user['statement_of_duly_signed_by_nominee'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">A statement duly signed by the nominee and the supervisor/co-author that academically or financially the thesis submitted for Sun Pharma Science Scholar Award-2021 has “non-conflict of interest” with the supervisor or co-authors (Max: 250KB)</label>
                <div class="col-sm-9">
              
                <?php if(is_array($statementOfDulySigned)): 
                        for($i=0; $i<count($statementOfDulySigned); $i++): ?>
                      <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$statementOfDulySigned[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$statementOfDulySigned[$i];?></a>
                      <?php endfor; 
                          else:?>
                        <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$statementOfDulySigned;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$statementOfDulySigned;?></a>
                      <?php endif;?>

                </div>
              </div>
              <?php endif;  if(!empty($user['citation'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Citation (brief summary) on the Research Work of the Applicant duly signed by the Nominator (Max: 300 KB)</label>
                <div class="col-sm-9">
                <?php if(is_array($citation)): 
                        for($i=0; $i<count($citation); $i++): ?>
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$citation[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$citation[$i];?></a> 
                <?php endfor; 
                      else:?>
                      <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$citation;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$citation;?></a> 
                      <?php endif;?>
                </div>
              </div>
              <?php endif; if(!empty($user['aggregate_marks'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Aggregate marks obtained in PCB/PCM in Class XII or any other course (Max: 250 KB)</label>
                <div class="col-sm-9">
               
                <?php if(is_array($aggregateMarks)): 
                        for($i=0; $i<count($aggregateMarks); $i++): ?>
                      <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$aggregateMarks[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$aggregateMarks[$i];?></a>
                      <?php endfor; 
                          else:?>
                        <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$aggregateMarks;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$aggregateMarks;?></a>
                      <?php endif;?>

                </div>
              </div>
              <?php endif; if(!empty($user['age_proof'])):?>
              <br />
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Age proof (Max: 250KB)</label>
                <div class="col-sm-9">
             
                <?php if(is_array($ageProof)): 
                        for($i=0; $i<count($ageProof); $i++): ?>
                      <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$ageProof[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$ageProof[$i];?></a>
                      <?php endfor; 
                          else:?>
                        <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$ageProof;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$ageProof;?></a>
                      <?php endif;?>

                </div>
              </div>
              <?php endif; if(!empty($user['declaration_candidate'])):?>
              <br />
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">A voluntary declaration from the candidate that they would work in the public or private funded academic/research based organizations for a minimum period of two years after completion of his/her studies. (Max: 250KB)</label>
                <div class="col-sm-9">
                <?php if(is_array($declarationCandidate)): 
                        for($i=0; $i<count($declarationCandidate); $i++): ?>
                      <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$declarationCandidate[$i];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$declarationCandidate[$i];?></a>
                      <?php endfor; 
                          else:?>
                        <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$declarationCandidate;?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$declarationCandidate;?></a>
                      <?php endif;?>

                </div>
              </div>
              <?php endif;?>
             <?php } ?> 

              <?php if(isset($userdata['role']) && ($userdata['role'] == '3') && (($user['status'] == 'Disapproved' && $user['is_rejected'] == '0') || ($user['status'] == 'Disapproved' && $user['active'] == '0'))): ?>
                <div class="">
                  <button type="button" onclick="getRemarks(this,'approve','<?=$user['user_id'];?>');" class="btn btn-success greenbg btn-lg">Approve</button>
                  <button type="button" class="btn btn-danger btn-lg" onclick="getRemarks(this,'disapprove','<?=$user['user_id'];?>');">
                    <i class="fa fa-ban"></i> Reject 
                </button>
              </div>
                <?php endif;?>

              </div>
            </div>
          </div>
        </div>
      </div>

            <?php if($userdata['role'] == 1 && $editdata['is_rate_submitted'] == 0): ?>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel xpanelform">
                   
                      <div class="page-title"  style="height: auto; border:0;">
                        <div class="container">
                          <div class="row">
                              <div class="col-md-8 text-center mx-auto">
                                  <h3 class="fw-bold heading" style="color: #F7941E;">Input your score out of 100 in the rating box !</h3>
                              </div>
                          </div>
                    </div>
                      
                      <div class="clearfix"></div>
                      <form id="ratingForm" action="<?php echo base_url();?>/<?=$uri;?>/nominee/view" method="POST" data-parsley-validate class="form-horizontal form-label-left giverating">
                      <?=csrf_field(); ?>           
                      <input type="hidden" name="nominee_id" value="<?=(isset($user['user_id']))?$user['user_id']:"";?>"  >

                                  <input type="hidden" name="id" value="<?=(isset($editdata['id']))?$editdata['id']:"";?>"  >

                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Rating <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" id="rating" name="rating" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('name',((isset($editdata['rating']) && !empty($editdata['rating']))?$editdata['rating']:""));?>">
                                    </div>
                                  </div>
                                  <div class="clearfix"></div>
                                  <div class="form-group col-md-6">
                                  <?php if(isset($validation) && $validation->getError('rating')) {?>
                                      <div class='alert alert-danger mt-2'>
                                        <?= $error = $validation->getError('rating'); ?>
                                      </div>
                                  <?php }?>
                                  </div>
                                  
                                  <div class="clearfix"></div>
                                  
                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Comments</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <div id="gender" class="btn-group ratingcommentcont" data-toggle="buttons">
                                        
                                          <textarea oninput="auto_grow(this)" style="height: 100px;" class="ratingcomment col-xs-12" name="comment" id="comment"><?=$editdata['comment'];?></textarea>
                                          
                                          <script>function auto_grow(element) {
                                            element.style.height = "5px";
                                            element.style.height = (element.scrollHeight)+"px";}
                                          </script>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="clearfix"></div>
                                  <div class="form-group col-md-6">
                                  <?php if(isset($validation) && $validation->getError('comment')) {?>
                                      <div class='alert alert-danger mt-2'>
                                        <?= $error = $validation->getError('comment'); ?>
                                      </div>
                                  <?php }?>
                                  </div>
                                
                                 
                                    <div class="form-group">
                                      <div class=""><br>
                                        <?php if(isset($editdata['is_rate_submitted']) && ($editdata['is_rate_submitted'] == 0)):?>
                                        <input type="submit" class="btn btn-primary" name="submit" value="Save Draft">
                                        <input type="button" class="btn btn-success" name="submit" value="SUBMIT" onclick="juryFinalSubmit('<?=$user['user_id'];?>');">
                                        <?php endif;?>
                                      </div>
                                    </div>
                                </form>
                              </div>
                           

            </div></div>

            <?php endif; ?>

            <?php // echo "<<pre>"; print_r($user); ?>
              <div class="page-title">
              <div class="title_left">
                <h3>Ratings</h3>
              </div>
            </div>
            <div class="row ratingslist">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                  <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Jury Name</th>
                          <th>Ratings</th>
                          <th>Comments</th>
                          <th>Mode</th>
                          <th>Rated Date</th>
                          <?php if($userdata['role'] == 3): ?>
                            <th>Action</th>
                          <?php endif; ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(is_array($ratings)):
                                foreach($ratings as $rating):
                            ?>
                        <tr>
                          <td><?=$rating['firstname'];?></td>
                          <td><?=$rating['rating'];?></td>
                          <td><?=$rating['comments'];?></td>
                          <td><?=(isset($rating['is_rate_submitted']) && ($rating['is_rate_submitted'] == 1))?'Submitted':'Draft';?></td>
                          <td><?=$rating['created_date'];?></td>
                          <?php if($userdata['role'] == 3): ?>
                           <td>
                          <a href="<?=base_url().'/admin/rating/add/'.$rating['id'].'/'.$rating['nominee_id'];?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                          <a href="<?=base_url().'/admin/rating/delete/'.$rating['id'].'/'.$rating['nominee_id'];?>" class="btn btn-info btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                          </td>
                          <?php endif;?>
                        </tr>
                        <?php endforeach;
                                endif;
                                ?>            
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

<!-- Modal -->
<div class="modal fade" id="remarksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remarks</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <textarea class="form-control" name="remarks" id="remarks"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-secondary" id="remarksSubmit">Submit</button>
      </div>
    </div>
  </div>
</div>

        