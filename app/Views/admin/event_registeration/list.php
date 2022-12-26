         
         <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Event Registration <small></small></h3>
              </div>
              
            </div>
           
            <div class="actionbtns">
                <a href="<?php echo base_url();?>/admin/eventregisteration/add" class="btn btn-primary btn-xs">
                   <i class="fa fa-plus"></i>Add/Modify Registration
                </a>

                <a href="#" onclick="exportRegistrations();" class="btn btn-primary mb-2">
                   <i class="fa fa-download"></i> Export
                </a>
           </div>

          
                
           </div>
            <div class="clearfix"></div>
            <?php if(session()->getFlashdata('msg')):?>
              <div class="alert alert-warning">
                  <?= session()->getFlashdata('msg') ?>
              </div>
            <?php endif;?>
            <?= csrf_field(); ?>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30"></p>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Registration Date</th>
                          <th>Firstname</th>
                          <th>Lastname</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Registration No</th>
                          <th>Participation Mode</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(is_array($lists)):
                                foreach($lists as $user):
                            ?>
                        <tr>
                          <td><?=$user['created_date'];?></td>
                          <td><?=$user['firstname'];?></td>
                          <td><?=$user['lastname'];?></td>
                          <td><?=$user['email'];?></td>
                          <td><?=(isset($user['phone']) && ($user['phone']!='2147483647'))?$user['phone']:"-";?></td>
                          <td><?=$user['registeration_no'];?></td>
                          <td><?=$user['mode'];?></td>
                          <td>
                            <a href="<?=base_url().'/admin/eventregisteration/add/'.$user['id'];?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>  </a>
                            <a onclick="userDelete('registration','<?=$user['id'];?>','/admin/eventregisteration/delete')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>  </a>
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