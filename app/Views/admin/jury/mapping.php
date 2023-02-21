<div class="right_col" role="main" style="min-height: 246px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Jury mapping with Awards</h3>
              </div>
            </div>

            <div class="clearfix"></div>
            <form method="POST" name="jury_mapping" class="form-horizontal" action="<?=base_url();?>/admin/jury/mapping">
                <?= csrf_field(); ?>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel minhight">
                <style>
                 .jurymapping .bootstrap-select .dropdown-menu.inner {
                    font-size: 16px;
                    }
                    .jurymapping .btn {
                        border: 1px solid;
                    }
                    .jurymapping .bootstrap-select {
                        width: 100%!important;
                    }
                    .bootstrap-select.show-tick .dropdown-menu .selected span.check-mark{color: #f7941e;}
                    .dropdown-item.active, .dropdown-item:active {
                        background: #047cb2;
                    }
                    .minhight{min-height:580px;}
                </style>
                  <div class="x_content jurymapping ">
                    <br>
                   
                                            <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 pt10" for="first-name">Award Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="selectpicker" multiple name="award[]" >
                        <?php if(count($awardLists)): 
                                foreach($awardLists as $akey=>$avalue): ?>
                                <option value="<?=$avalue['id'];?>"><?=$avalue['title'];?></option>
                         <?php endforeach; endif;?>       
                        </select>
                        </div>
                      </div>
                      <div class="clearfix"></div>
<br>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 pt10" for="first-name">Jury <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="selectpicker" multiple name="jury">
                       <?php if(count($juryLists)): 
                               foreach($juryLists as $jkey=>$jvalue): ?>
                               <option value="<?=$jvalue['id'];?>"><?=$jvalue['firstname'].' '.$jvalue['lastname'];?></option>
                        <?php endforeach; endif;?>        
                       </select>
                        </div>
                      </div>
                      
                      <div class="clearfix"></div>
                      
                      <div class="row justify-content-center">
                      
                      <div class="col-md-6 col-lg-4 d-flex justify-content-center align-items-center">
                        <?php if(isset($validation) && $validation->getError('jury')) {?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('jury'); ?>
                            </div>
                        <?php }?>
                      </div>
                      <div class="col-md-6 col-lg-4 d-flex justify-content-center align-items-center">
                        <?php if(isset($validation) && $validation->getError('award')) {?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('award'); ?>
                            </div>
                        <?php }?>
                      </div> 
                </div>
                     
                      <div class="ln_solid"></div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <input type="submit" class="btn btn-success" name="jurymap_submit" value="ASSIGN">
                            
                          </div>
                        </div>

             
                  </div>
                </div>
              </div>
            </div></form>

    <!-- Footer Menu -->
    
      

    </div>
    </div>




