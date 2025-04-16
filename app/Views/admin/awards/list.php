         
         <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Fellowship Results<small></small></h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <?= csrf_field(); ?>
            <div class="row topformsec">
              
              <div class="col-md-3">
                <div class="get-sunpharma__input-box mt-2 form-inline">
                    <label for="" class="fw-bold">Fellowships</label>
                        <select class="selectpicker mt-2 form-control"
                            aria-label="Default select example" name="main_category_id" id="main_category_id" >
                            <option></option>
                            <?php if(is_array($main_categories)):
                                    foreach($main_categories as $ckey=>$cvalue):?>
                            <option value="<?=$cvalue['id'];?>" ><?=$cvalue['name'];?></option>
                            <?php endforeach; endif; ?> 
                        </select>
                       
                    </div>
              </div>

            
          
            <div class="col-md-3 searchbtn">
                <button class="btn btn-primary mb-2" name="search" id="search" onclick="getAwardLists()">Search</button>
            </div>
            <?php 
                if(is_array($lists) && count($lists) > 0): ?>
            <div class="col-md-3 actionbtns">
                <a href="#" onclick="exportResult();" class="btn btn-primary mb-2 downloadbtnres">
                   <i class="fa fa-download"></i> Download Result
                </a>
            </div>
            <?php endif; ?>
        </div>
            
            <div class="clearfix"></div>
            <?php if(session()->getFlashdata('msg')):?>
              <div class="alert alert-warning">
                  <?= session()->getFlashdata('msg') ?>
              </div>
            <?php endif;?>
            <div class="row awardrating">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                    </p>
                    
                      <div id="getLists">
                          <?php 
			    $currentYear = date("Y");
                            if(is_array($lists)):
                              foreach($lists as $user): //print_r($user); die;
				switch ($user['nomination_type']) {
            			case 'ssan':
              			     $fileUploadDir = base_url().'/uploads/'.$user['nomination_year'].'/RA/'.$user['id'].'/'.$user['nominator_photo'];
				      $atype ='RA';	
               			    break;
           			 case 'spsfn':
               			     $fileUploadDir = base_url().'/uploads/'.$user['nomination_year'].'/SSA/'.$user['id'].'/'.$user['nominator_photo'];
				    $atype = 'SSA';
                		    break; 
          			 case 'fellowship':
			             $fileUploadDir = base_url().'/uploads/'.$user['nomination_year'].'/CRF/'.$user['id'].'/'.$user['nominator_photo'];
				     $atype = 'CRF';	
                                     break;
                           }

                            ?>
                              <div data-toggle="modal" data-target="#juryListsModal" class="col-md-3 col-xs-12 mt-30" onclick="geJuryLists(<?=$user['id'];?>);">
                                  <div class="product-image border avatarimg" style="background: #fafafa;border:0!important; margin-top:10px;">
                                    <img class="border" src="<?=$fileUploadDir;?>" alt="" style="border:0!important;padding: 5px;">
                                    <!--<img class="uploadPreview" src="<?//base_url();?>/frontend/assets/img/user--default-Image.png" width="200"
                                                height="200" />-->
                                  </div>
                                  <div class="product_gallery">
                                     <h2 class="fname" align="center"><?=$user['firstname'];?></h2>
                                     <h3 class="catname" align="center"><?=$user['category'];?></h3>
                                     <h4 class="averrating" align="center"><span class="badge badge-warning"><i class="fa fa-star"></i> <?=round($user['average_rating']);?></span></h4>
                                  </div>
                                </div>
                              <?php endforeach;
                                     endif; ?>  
                              </div>       
                                
                  </div>
                </div>
              </div>
        <!-- /page content -->
      </div>
    </div>

    <div class="modal fade" id="juryListsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Jury Lists</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="juryListss">
        
        </div>
        <div class="modal-footer">
          
        </div>
    </div>
  </div>
</div>
