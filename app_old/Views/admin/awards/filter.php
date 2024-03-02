<?php if(is_array($lists) && count($lists) > 0):
        foreach($lists as $user):
?>
    <div data-toggle="modal" data-target="#juryListsModal" class="col-md-3 col-xs-12 mt-30" onclick="geJuryLists(<?=$user['id'];?>);">
        <div class="product-image border avatarimg">
        <img class="border" src="<?=base_url();?>/uploads/<?=$user['id'];?>/<?=$user['nominator_photo'];?>" alt="" style="border: 1px solid #959595;padding: 5px;"> 
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
          <p>No Awards Found!</p> 
        </div>
    <?php        
        endif;
?>

