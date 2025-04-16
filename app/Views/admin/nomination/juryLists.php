<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Name</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody id="getLists">
      <?php if(is_array($juries) && count($juries) > 0):  
        foreach($juries as $ukey => $uvalue): ?>
          <tr>
              <td><?=$uvalue['firstname'].' '.$uvalue['lastname'];?></td>
              <td><button type="button" name="unassign_jury" onclick="removeJuryFromAward('<?=$uvalue['map_id'];?>');">UnAssign</button></td>
          </tr>
        <?php endforeach;
        else: ?>
        <tr>
           <td colspan="2">No Juries Found</td>
        </tr>  
    <?php
        endif; ?>
  </tbody>
</table>