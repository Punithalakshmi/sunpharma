<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Name</th>
      <th>Rating</th>
    </tr>
  </thead>
  <tbody id="getLists">
      <?php if(is_array($juries) && count($juries) > 0):  
        foreach($juries as $ukey => $uvalue): if(isset($uvalue['is_rate_submitted']) && ($uvalue['is_rate_submitted'] == 1)):?>
          <tr>
              <td><?=$uvalue['firstname'].' '.$uvalue['lastname'];?></td>
              <td><?=$uvalue['rating'];?></td>
          </tr>
        <?php endif; endforeach;
        endif; ?>
  </tbody>
</table>