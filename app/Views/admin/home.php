<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="row tile_count">
    
    </div>
    <!-- /top tiles -->
    <div id="dashboardsec">
    <?php if($userdata['role'] == 3){ ?>
    <h1>Welcome to Sun Pharma Science Foundation Admin Panel</h1>
    <?php } ?>

    <div class="menu_section">
               
                <ul class="nav side-menu">
                <?php if($userdata['role'] == 3){ ?>
                  <li><a href="<?php echo base_url();?>/admin/user">
                    <i class="fa fa-user"></i> Users </a>
                  </li>
                  <li><a href="<?php echo base_url();?>/admin/nominee">
                    <i class="fa fa-user"></i> Nominees </a>
                  </li>
                  <li><a href="<?php echo base_url();?>/admin/category">
                    <i class="fa fa-user"></i> Award Types </a>
                  </li>
                  <li><a href="<?php echo base_url();?>/admin/nomination">
                    <i class="fa fa-user"></i> Manage Awards</a>
                  </li>
                  <li>
                    <a href="<?php echo base_url();?>/admin/workshops">
                      <i class="fa fa-user"></i> Workshops 
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo base_url();?>/admin/awards">
                      <i class="fa fa-user"></i> Reports 
                    </a>
                  </li>
                  <?php } ?>
                   <?php if($userdata['role'] == 1){ ?>
                    <li><a href="<?php echo base_url();?>/admin/nominee/lists">
                      <i class="fa fa-user"></i> Nominations </a>
                    </li>
                  <?php  } ?>
                  </ul>
              </div>

    </div>
</div>
<!-- /page content -->

        