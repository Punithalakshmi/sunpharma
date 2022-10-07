<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Nominee Details</h3>
              </div>
              <div class="title_right">
                <h3>Average Rating: <?=round($average_rating);?></h3>
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
      <div class="x_panel">
       
        <div class="x_content">

          <div class="col-md-3 col-xs-12 mt-30">
            <div class="product-image border">
                              <img class="border" src="http://local.sunpharma.md/uploads/7/robots.jpg" alt="" style="
    border: 1px solid #959595;
    padding: 5px;
">
                
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
                <label class="col-sm-3 col-form-label">In Order of Importance list of 10 best papers of the applicant highlighting the important discoveries/contribution described in them briefly.(Max 1 MB)</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['best_papers'];?>" target="_blank" class="documents" style="color:blue;"><?=$user['best_papers'];?></a> 
                </div>
              </div>

              <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">Statement of Research Achievements, if any, on which any Award has already been Received by the Applicant. Please also upload brief citations on the research works for which the applicant has already received the awards</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['statement_of_research_achievements'];?>" target="_blank" class="documents" style="color:blue;"><?=$user['statement_of_research_achievements'];?></a> 
                </div>
              </div>

              <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">Signed details of the excellence in research work for which the Sun Pharma Research Award is claimed, including references and illustrations. The candidate should duly sign on the details.</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['signed_details'];?>" target="_blank" class="documents" style="color:blue;"><?=$user['signed_details'];?></a> 
                </div>
              </div>

              <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">Two specific publications/research papers of the applicant relevent to the research work mentioned above.(Max: 2.5MB)</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['specific_publications'];?>" target="_blank" class="documents" style="color:blue;"><?=$user['specific_publications'];?></a> 
                </div>
              </div>

              <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">A signed statement by the applicant that the research work under reference has not been given any award. The applicant should also indicate the extent of the contribution of the others associated with the research and he/she should clearly acknowledge his/her achievements (Max: 500KB)</label>
                <div class="col-sm-9">
                <a href="<?=base_url();?>/uploads/<?=$user['user_id'];?>/<?=$user['signed_statement'];?>" target="_blank" class="documents" style="color:blue;"><?=$user['signed_statement'];?></a> 
                </div>
              </div>

              <div class="form-group row formitem">
                <label class="col-sm-3 col-form-label">Citation on the Research Work of the Applicant duly signed by the Naminator(Max: 300 KB)</label>
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
              <?php if(isset($userdata['role']) && ($userdata['role'] == '3')): ?>
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

            <?php if($userdata['role'] == 1): ?>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Rating</h2>
          
          <div class="clearfix"></div>
          <form id="categoryForm" action="<?php echo base_url();?>/admin/nominee/view" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                      <input type="hidden" name="nominee_id" value="<?=(isset($user['id']))?$user['id']:"";?>"  >

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
                            
                              <textarea class="ratingcomment col-xs-12" name="comment"><?=$editdata['comment'];?></textarea>
                           
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
                     
                      <div class="ln_solid"></div>
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


        