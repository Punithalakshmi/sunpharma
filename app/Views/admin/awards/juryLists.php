<table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Rating</th>
                </tr>
              </thead>
              <tbody id="getLists">
                  <?php if(is_array($juries) && count($juries) > 0):  
                    foreach($juries as $ukey => $uvalue): ?>
                      <tr>
                          <td><?=$uvalue['firstname'].' '.$uvalue['lastname'];?></td>
                          <td><?=$uvalue['rating'];?></td>
                      </tr>
                    <?php endforeach;
                    endif; ?>
              </tbody>
            </table>