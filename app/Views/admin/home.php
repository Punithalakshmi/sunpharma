<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="row tile_count">
    
    </div>
    <!-- /top tiles -->
    <div id="dashboardsec">
    <?php //print_r($userdata); 
    if($userdata['role'] == 3){ ?>
    <h1>Welcome to Sun Pharma Science Foundation Admin Panel</h1>
    <?php } ?>

    <div class="menu_section">
               
                <ul class="nav side-menu">
                <?php if($userdata['role'] == 3){ ?>
                  <li><a href="<?php echo base_url();?>/admin/user">
                    <i class="fa fa-user"></i> Users </a>
                  </li>
                  <li><a href="<?php echo base_url();?>/admin/nominee">
                    <i class="fa fa-solid fa-users"></i> Nominees </a>
                  </li>
                  <li><a href="<?php echo base_url();?>/admin/category">
                    <i class="fa fa-solid fa-list"></i> Categories </a>
                  </li>
                  <li><a href="<?php echo base_url();?>/admin/nomination">
                    <i class="fa fa-solid fa-flag-checkered"></i> Awards Creation </a>
                  </li>
                  <li>
                    <a href="<?php echo base_url();?>/admin/workshops">
                      <i class="fa fa-solid fa-calendar"></i> Events 
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo base_url();?>/admin/eventregisteration">
                      <i class="fa fa-solid fa-tv"></i> Event Registration 
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo base_url();?>/admin/awards">
                      <i class="fa fa-solid fa-trophy"></i> Award Results  
                    </a>
                  </li>
                  <?php } ?>
                   <?php if($userdata['role'] == 1){ ?>
                    <li><a href="<?php echo base_url();?>/admin/nominee/lists">
                      <i class="fa fa-solid fa-users"></i> Nominations </a>
                    </li>
                  <?php  } ?>
                  </ul>
              </div>

    </div>
</div>
<!-- /page content -->

        