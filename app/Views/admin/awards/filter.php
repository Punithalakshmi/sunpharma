<?php if(is_array($lists) && count($lists) > 0):
        foreach($lists as $user):
?>
    <tr>
        <td><?=$user['category_name'];?></td>
        <td><?=$user['firstname'];?></td>
        <td><?=date("Y")."/".$user['id'];?></td>
        <td><?=$user['dob'];?></td>
        <td><?=round($user['average_rating']);?></td>
    </tr>
<?php    endforeach;
        else: 
    ?>
      <tr>
          <td colspan="5">No Awards Found!</td> 
       </tr>
    <?php        
        endif;
?>