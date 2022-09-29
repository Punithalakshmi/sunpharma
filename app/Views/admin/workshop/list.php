         
         <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Workshops <small></small></h3>
              </div>
            </div>
           
            <div>
                <a href="<?php echo base_url();?>/admin/workshops/add" class="btn btn-primary btn-xs">Add Event</a>
           </div>
                
           </div>
            <div class="clearfix"></div>
            <?php if(session()->getFlashdata('msg')):?>
              <div class="alert alert-warning">
                  <?= session()->getFlashdata('msg') ?>
              </div>
            <?php endif;?>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                    </p>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          
                          <th>Event Name</th>
                          <th>Description</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Created Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(is_array($lists)):
                                foreach($lists as $user):
                            ?>
                        <tr>
                          
                          <td><?=$user['name'];?></td>
                          <td><?=$user['description'];?></td>
                          <td><?=$user['start_name'];?></td>
                          <td><?=$user['end_date'];?></td>
                          <td><?=$user['created_date'];?></td>
                          <td>
                         
                          </td>
                        </tr>
                        <?php endforeach;
                                endif;
                                ?>            
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>