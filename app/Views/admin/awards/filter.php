<?php if(is_array($lists) && count($lists) > 0):
        foreach($lists as $user):
?>
    <tr>
    <td><span class="expandChildTable"></span></td>
        <td><?=$user['category_name'];?></td>
        <td><?=$user['firstname'];?></td>
        <td><?=date("Y")."/".$user['id'];?></td>
        <td><?=$user['dob'];?></td>
        <td><?=round($user['average_rating']);?></td>
        <?php if(is_array($user['juries']) && count($user['juries']) > 0): ?>
        <tr class="childTableRow">
            <td colspan="6">
                <h5>Jury Info</h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Jury</th>
                        <th>Rating</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($user['juries'] as $ukey => $uvalue): ?>
                        <tr>
                            <td><?=$uvalue['firstname'].' '.$uvalue['lastname'];?></td>
                            <td><?=$uvalue['rating'];?></td>
                        </tr>
                    <?php endforeach;?>  
                    </tbody>
                </table>
            </td>            
        </tr>
    <?php    
        endif;
        endforeach;      
        else: 
    ?>
      <tr>
          <td colspan="5">No Awards Found!</td> 
       </tr>
    <?php        
        endif;
?>

<script>
    
    $('#getLists .expandChildTable').on('click', function() {
        $(this).toggleClass('selected').closest('tr').next().toggle();
    })

</script>