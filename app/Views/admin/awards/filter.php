<?php $currentYear = date('Y'); $fileUploadDir = '';
 if(is_array($lists) && count($lists) > 0):
        foreach($lists as $user):
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
        <div class="product-image border avatarimg">
        <img class="border" src="<?=$fileUploadDir;?>" alt="" style="border: 1px solid #959595;padding: 5px;"> 
        </div>
        <div class="product_gallery">
            <h2 class="fname" align="center"><?=$user['firstname'];?></h2>
            <h3 class="catname" align="center"><?=$user['category'];?></h3>
            <h4 class="averrating" align="center"><span class="badge badge-warning"><i class="fa fa-star"></i> <?=round($user['average_rating']);?></span></h4>
        </div>
    </div>
    <?php    
        
        endforeach;      
        else: 
    ?>
       <div data-toggle="modal">
          <p>No Fellowships Found!</p> 
        </div>
    <?php        
        endif;
?>

