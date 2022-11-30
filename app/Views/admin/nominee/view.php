<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Nominee Details</h3>
              </div>
              <div class="title_right">
               
                <h3>Average Rating: <span class="badge badge-warning"><i class="fa fa-star"></i> <?=($average_rating>0)?round($average_rating):0;?></span></h3>
                <?php if($user['status'] == 'Approved' && $user['active'] == 1): ?>
                  <h3 class="approvedtxt"><span class="badge badge-success">
                    <i class="fa fa-check-circle"></i> Approved</span>
                </h3>
                <?php else: ?>
                  <h3 class="disapprovedtxt"><span class="badge badge-info"><i class="fa fa-times-circle"></i> Pending </span></h3>
                  <?php endif; ?>
              </div>
             
            </div>
            <div class="clearfix"></div>
            
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

            <h3 class="prod_title"><?=$user['firstname'].' '.$user['lastname'];?> </h3>

            <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">Award Category</label>
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
            <?php if(isset($user['nomination_type']) && ($user['nomination_type'] == 'ssan')): ?>
              <div class="form-group row formitem graybox">
                <label class="col-sm-3 col-form-label">Justification Letter</label>
                <div class="col-sm-9">
                   <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['justification_letter_filename'];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$user['justification_letter_filename'];?></a>
               </div>
              </div>

              <div class="form-group row formitem graybox">
                <label class="col-sm-3 col-form-label">Passport</label>
                <div class="col-sm-9">
                  <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['passport_filename'];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$user['passport_filename'];?></a> 
                </div>
              </div>
             <?php if(!empty($user['complete_bio_data'])):?>
              <div class="form-group row formitem graybox">
                <label class="col-sm-3 col-form-label">Complete Bio-data of the applicant</label>
                <div class="col-sm-9">
                  <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['complete_bio_data'];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$user['complete_bio_data'];?></a>  
                </div>
              </div>
             <?php endif;
              if(!empty($user['best_papers'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">In Order of Importance list of 10 best papers of the applicant highlighting the important discoveries/contribution described in them briefly.(Max 1 MB)</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['best_papers'];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$user['best_papers'];?></a> 
                </div>
              </div>

              <?php endif; if(!empty($user['statement_of_research_achievements'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Statement of Research Achievements, if any, on which any Award has already been Received by the Applicant. Please also upload brief citations on the research works for which the applicant has already received the awards</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['statement_of_research_achievements'];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$user['statement_of_research_achievements'];?></a> 
                </div>
              </div>
             
              <?php endif; if(!empty($user['signed_details'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Signed details of the excellence in research work for which the Sun Pharma Research Award is claimed, including references and illustrations. The candidate should duly sign on the details.</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['signed_details'];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$user['signed_details'];?></a> 
                </div>
              </div>
              <?php endif; if(!empty($user['specific_publications'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Two specific publications/research papers of the applicant relevent to the research work mentioned above.(Max: 2.5MB)</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['specific_publications'];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$user['specific_publications'];?></a> 
                </div>
              </div>
              <?php endif; if(!empty($user['signed_statement'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">A signed statement by the applicant that the research work under reference has not been given any award. The applicant should also indicate the extent of the contribution of the others associated with the research and he/she should clearly acknowledge his/her achievements (Max: 500KB)</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['signed_statement'];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$user['signed_statement'];?></a> 
                </div>
              </div>
              <?php endif; if(!empty($user['citation'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Citation on the Research Work of the Applicant duly signed by the Naminator(Max: 300 KB)</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['citation'];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$user['citation'];?></a> 
                </div>
              </div>
              <?php endif;?>
              <?php else: ?>
                <?php if(!empty($user['justification_letter_filename'])):?>
                <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Letter from the supervisor certifying that the research work submitted for Sun Pharma Science Scholar Award has actually been done by the applicant(500 KB)</label>
                <div class="col-sm-9">
                   <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['justification_letter_filename'];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$user['justification_letter_filename'];?></a>
               </div>
              </div>
              <?php endif; if(!empty($user['supervisor_certifying'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Justification for Sponsoring the Nomination duly signed by the Nominator/Supervisor(500 KB)</label>
                <div class="col-sm-9">
                  <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['supervisor_certifying'];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$user['supervisor_certifying'];?></a> 
                </div>
              </div>
              <?php endif; if(!empty($user['complete_bio_data'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Complete Bio-data of the applicant(Max: 1MB) pdf format</label>
                <div class="col-sm-9">
                  <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['complete_bio_data'];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$user['complete_bio_data'];?></a>  
                </div>
              </div>
              <?php endif; if(!empty($user['excellence_research_work'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Details of the excellence in research work for which the Sun Pharma Science Scholar Award is claimed, including references and illustrations with following headings- Title, Introduction, Objectives, Materials and Methods, Results, Statistical Analysis, Discussion, Impact of the research in the advancement of knowledge or benefit to mankind, Literature reference. The candidate should duly sign on the details.(Max 2 MB)</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['excellence_research_work'];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$user['excellence_research_work'];?></a> 
                </div>
              </div>
              <?php endif; if(!empty($user['lists_of_publications'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">List of Publications, if any. If yes, Upload copies of any two publications (Max: 2 MB)</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['lists_of_publications'];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$user['lists_of_publications'];?></a> 
                </div>
              </div>
              <?php endif; if(!empty($user['statement_of_applicant'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Statement of Merits/Awards/Scholarships already received by the Applicant (Max: 1 MB)</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['statement_of_applicant'];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$user['statement_of_applicant'];?></a> 
                </div>
              </div>
              <?php endif; if(!empty($user['ethical_clearance'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">A letter stating that the project submitted for the award has received “ethical clearance” (Max: 250KB)</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['ethical_clearance'];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$user['ethical_clearance'];?></a> 
                </div>
              </div>
              <?php endif; if(!empty($user['statement_of_duly_signed_by_nominee'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">A statement duly signed by the nominee and the supervisor/co-author that academically or financially the thesis submitted for Sun Pharma Science Scholar Award-2021 has “non-conflict of interest” with the supervisor or co-authors (Max: 250KB)</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['statement_of_duly_signed_by_nominee'];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$user['statement_of_duly_signed_by_nominee'];?></a> 
                </div>
              </div>
              <?php endif; if(!empty($user['citation'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Citation (brief summary) on the Research Work of the Applicant duly signed by the Nominator (Max: 300 KB)</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['citation'];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$user['citation'];?></a> 
                </div>
              </div>
              <?php endif; if(!empty($user['aggregate_marks'])):?>
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Aggregate marks obtained in PCB/PCM in Class XII or any other course (Max: 250 KB)</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['aggregate_marks'];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$user['aggregate_marks'];?></a> 
                </div>
              </div>
              <?php endif; if(!empty($user['age_proof'])):?>
              <br />
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">Age proof (Max: 250KB)</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['age_proof'];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$user['age_proof'];?></a> 
                </div>
              </div>
              <?php endif; if(!empty($user['declaration_candidate'])):?>
              <br />
              <div class="form-group row formitem graybox">
                <label class="col col-form-label nonecolan">A voluntary declaration from the candidate that they would work in the public or private funded academic/research based organizations for a minimum period of two years after completion of his/her studies. (Max: 250KB)</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['declaration_candidate'];?>" target="_blank" class="documents"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?=$user['declaration_candidate'];?></a> 
                </div>
              </div>
              <?php endif;?>
             <?php endif; ?> 

              <?php if(isset($userdata['role']) && ($userdata['role'] == '3') && (($user['status'] == 'Disapproved' && $user['is_rejected'] == '0') || ($user['status'] == 'Disapproved' && $user['active'] == '0'))): ?>
                <div class="">
                  <button type="button" onclick="nominee_approve('approve','<?=$user['user_id'];?>');" class="btn btn-success greenbg btn-lg">Approve</button>
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

            <?php if($userdata['role'] == 1): ?>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel xpanelform">
                   
                      <div class="page-title"  style="height: auto; border:0;">
                      <div class="container">
            <div class="row">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h3 class="fw-bold heading" style="color: #F7941E;">Give Your Rating(100/100) and Share your comments</h3>
                </div>
            </div>
        </div>
                      
                      <div class="clearfix"></div>
                      <form id="categoryForm" action="<?php echo base_url();?>/admin/nominee/view" method="POST" data-parsley-validate class="form-horizontal form-label-left giverating">
                                  <input type="hidden" name="nominee_id" value="<?=(isset($user['user_id']))?$user['user_id']:"";?>"  >

                                  <input type="hidden" name="id" value="<?=(isset($editdata['id']))?$editdata['id']:"";?>"  >

                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Rating <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" id="first-name" name="rating" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('name',((isset($editdata['rating']) && !empty($editdata['rating']))?$editdata['rating']:""));?>">
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
                                        
                                          <textarea oninput="auto_grow(this)" style="height: 100px;" class="ratingcomment col-xs-12" name="comment"><?=$editdata['comment'];?></textarea>
                                          
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
                                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <?php if(isset($editdata['is_rate_submitted']) && ($editdata['is_rate_submitted'] == 0)):?>
                                        <input type="submit" class="btn btn-primary" name="submit" value="Save Draft">
                                        <input type="submit" class="btn btn-success" name="submit" value="SUBMIT">
                                        <?php endif;?>
                                      </div>
                                    </div>
                                </form>
                              </div>
                           

            </div></div>

            <?php else: ?>
              <div class="page-title">
              <div class="title_left">
                <h3>Ratings</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                  <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Juryname</th>
                          <th>Ratings</th>
                          <th>Comments</th>
                          <th>Rated Date</th>
                          <th>Action</th>
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
                          <td><?=$rating['created_date'];?></td>
                          <td>
                          <a href="<?=base_url().'/admin/rating/add/'.$rating['id'].'/'.$rating['nominee_id'];?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                          <a href="<?=base_url().'/admin/rating/delete/'.$rating['id'].'/'.$rating['nominee_id'];?>" class="btn btn-info btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                           
                          </td>
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
<?php endif;?>


        