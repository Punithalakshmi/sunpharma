<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Jury mapping with awards</h2>
				</div>
			</div>
            <form method="POST" name="jury_mapping" action="<?=base_url();?>/admin/jury/mapping">
                <?= csrf_field(); ?>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4 d-flex justify-content-center align-items-center">
                       
                        <select class="selectpicker" name="jury">
                        <?php if(count($juryLists)): 
                                foreach($juryLists as $jkey=>$jvalue): ?>
                                <option value="<?=$jvalue['id'];?>"><?=$jvalue['firstname'].' '.$jvalue['lastname'];?></option>
                         <?php endforeach; endif;?>        
                        </select>
                    </div>
                    
                    <div class="col-md-6 col-lg-4 d-flex justify-content-center align-items-center">
                        <select class="selectpicker" multiple name="award[]" >
                        <?php if(count($awardLists)): 
                                foreach($awardLists as $akey=>$avalue): ?>
                                <option value="<?=$avalue['id'];?>"><?=$avalue['title'];?></option>
                         <?php endforeach; endif;?>       
                        </select>
                    </div>
                    
                </div>
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
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4 d-flex justify-content-center align-items-center">
                        <input type="submit" name="jurymap_submit" value="ASSIGN">
                    </div>
                </div>    
          </form>
				
			
		</div>
	</section>