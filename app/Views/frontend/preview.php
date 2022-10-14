<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_content">

                <div class="col-md-3 col-xs-12 mt-30">
                  <div class="product-image border">
                    <img class="border" src="http://local.sunpharma.md/uploads/7/robots.jpg" alt="" style="border: 1px solid #959595;padding: 5px;"> 
                  </div>
                  <div class="product_gallery">
                  
                  </div>
                </div>

          <div class="col-md-8 col-xs-12" style="border:0px solid #e5e5e5;">

            <h3 class="prod_title"><?=$user['firstname'].' '.$user['lastname'];?> </h3>

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
            <?php if(isset($user['nomination_type']) && ($user['nomination_type'] == 'spsfn')): ?>
              <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">Justification Letter</label>
                <div class="col-sm-9">
                   <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['justification_letter_filename'];?>" target="_blank" class="documents" style="color:blue;"><?=$user['justification_letter_filename'];?></a>
               </div>
              </div>

              <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">Passport</label>
                <div class="col-sm-9">
                  <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['passport_filename'];?>" target="_blank" class="documents" style="color:blue;"><?=$user['passport_filename'];?></a> 
                </div>
              </div>

              <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">Complete Bio-data of the applicant</label>
                <div class="col-sm-9">
                  <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['complete_bio_data'];?>" target="_blank" class="documents" style="color:blue;"><?=$user['complete_bio_data'];?></a>  
                </div>
              </div>

              <div class="form-group row formitem">
                <label class="col col-form-label">In Order of Importance list of 10 best papers of the applicant highlighting the important discoveries/contribution described in them briefly.(Max 1 MB)</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['best_papers'];?>" target="_blank" class="documents" style="color:blue;"><?=$user['best_papers'];?></a> 
                </div>
              </div>

              <div class="form-group row formitem">
                <label class="col col-form-label">Statement of Research Achievements, if any, on which any Award has already been Received by the Applicant. Please also upload brief citations on the research works for which the applicant has already received the awards</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['statement_of_research_achievements'];?>" target="_blank" class="documents" style="color:blue;"><?=$user['statement_of_research_achievements'];?></a> 
                </div>
              </div>

              <div class="form-group row formitem">
                <label class="col col-form-label">Signed details of the excellence in research work for which the Sun Pharma Research Award is claimed, including references and illustrations. The candidate should duly sign on the details.</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['signed_details'];?>" target="_blank" class="documents" style="color:blue;"><?=$user['signed_details'];?></a> 
                </div>
              </div>

              <div class="form-group row formitem">
                <label class="col col-form-label">Two specific publications/research papers of the applicant relevent to the research work mentioned above.(Max: 2.5MB)</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['specific_publications'];?>" target="_blank" class="documents" style="color:blue;"><?=$user['specific_publications'];?></a> 
                </div>
              </div>

              <div class="form-group row formitem">
                <label class="col col-form-label">A signed statement by the applicant that the research work under reference has not been given any award. The applicant should also indicate the extent of the contribution of the others associated with the research and he/she should clearly acknowledge his/her achievements (Max: 500KB)</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['signed_statement'];?>" target="_blank" class="documents" style="color:blue;"><?=$user['signed_statement'];?></a> 
                </div>
              </div>

              <div class="form-group row formitem">
                <label class="col col-form-label">Citation on the Research Work of the Applicant duly signed by the Naminator(Max: 300 KB)</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['citation'];?>" target="_blank" class="documents" style="color:blue;"><?=$user['citation'];?></a> 
                </div>
              </div>
              <?php else: ?>

             <?php endif; ?> 
              <div class="">
                <div class="product_price">
                  <h2><?=$user['category_name'];?></h2>
                  <span>Award Category</span>
                  <br>
                </div>
              </div>

              <?php if(isset($userdata['role']) && ($userdata['role'] == '3') && ($user['status'] == 'Disapproved') && ($user['active'] == '0')): ?>
                <div class="">
                  <button type="button" onclick="nominee_approve('approve','<?=$user['user_id'];?>');" class="btn btn-primary btn-lg">Approve</button>
                  <button type="button" class="btn btn-danger btn-lg" onclick="nominee_approve('disapprove','<?=$user['user_id'];?>');">
                    <i class="fa fa-ban"></i> Reject 
                </button>
              </div>
                <?php endif;?>

              </div>
            </div>
          </div>
        </div>
      </div>