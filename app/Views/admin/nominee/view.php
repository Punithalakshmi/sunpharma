<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Personal Info</h3>
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
                    <br />
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <h4>First Name: <small> <?=$user['firstname'];?></small></h4>
                   </div>  
                   <div class="col-md-3 col-sm-6 col-xs-12">
                      <h4>Last Name: <small> <?=$user['lastname'];?></small></h4>
                   </div>
                   <div class="col-md-3 col-sm-6 col-xs-12">
                      <h4>Email: <small> <?=$user['email'];?></small></h4>
                   </div>
                      
                   <div class="col-md-3 col-sm-6 col-xs-12">
                      <h4>Phone: <small> <?=$user['phone'];?></small></h4>
                   </div>
                  </div>
                </div>
              </div>
            </div>

            <?php if($userdata['role'] == 1): ?>
          <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Rating</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                
                  <div class="x_content">
                    <br />
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
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <p>
                              <textarea name="comment"><?=$editdata['comment'];?></textarea>
                           </p>
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
                            <input type="reset" class="btn btn-primary" name="reset" value="RESET">
                            <input type="submit" class="btn btn-success" name="submit" value="SUBMIT">
                          </div>
                        </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
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
