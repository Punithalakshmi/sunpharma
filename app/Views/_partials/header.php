

  <?php if(is_array($userdata)):  
          $logoUrl = ($userdata['role'] == 3)?'/admin':'/admin/nominee/lists';
     ?>
    <div class="container body">

      <div class="main_container">
        
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
              <a href="<?=base_url();?>/<?=$logoUrl;?>" class="site_title">
                <img class="logo img-responsive desklogo" src="<?php echo base_url();?>/images/logo.jpg" alt="Sun Pharma Science Foundation" />
                <img class="logo img-responsive mobilelogo" src="<?php echo base_url();?>/images/logo-mini.svg" alt="Sun Pharma Science Foundation" />
              </a>
            </div>

            <div class="clearfix"></div>

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
               
                <ul class="nav side-menu">
                  
                  <?php if($userdata['role'] == 3){ ?>
                    <li><a href="<?php echo base_url();?>/admin/user">
                    <i class="fa fa-user"></i> Users </a>
                  </li>
                  <li><a href="<?php echo base_url();?>/admin/nominee">
                    <i class="fa fa-solid fa-users"></i> Nominees </a>
                  </li>
                  <li><a href="<?php echo base_url();?>/admin/jury/mapping">
                    <i class="fa fa-solid fa-users"></i> Jury Mapping </a>
                  </li>
                  <li><a href="<?php echo base_url();?>/admin/category">
                    <i class="fa fa-solid fa-list"></i> Award Types </a>
                  </li>
                  <li><a href="<?php echo base_url();?>/admin/nomination">
                    <i class="fa fa-solid fa-flag-checkered"></i> Manage Awards </a>
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
                  <?php } else if($userdata['role'] == 1){ ?>
                    <li><a href="<?php echo base_url();?>/admin/nominee/lists">
                      <i class="fa fa-solid fa-users"></i> Nominations </a>
                    </li>
                    <!-- <li><a href="<?php //echo base_url();?>/admin/nominee/ratings">
                      <i class="fa fa-user"></i> Rated Nominees </a>
                  </li> -->
                  <?php }else{}?>
                </ul>
              </div>
              

            </div>
            <!-- /sidebar menu -->

            <p class="copyrightadmin" style="color: var(--bs-gray-400);font-size: 13px;">Copyright © 2022 Sun Pharma Science Foundation.</p>
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <!-- <img src="images/img.jpg" alt=""> --><?=ucfirst($userdata['login_name']);?>
                    
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo base_url();?>/admin/profile"><i class="fa fa-user pull-right"></i> Profile</a></li>
                    <li><a href="<?php echo base_url();?>/admin/reset_password/<?=$userdata['id'];?>"><i class="fa fa-user pull-right"></i> Reset Password</a></li>
                    <li><a href="<?php echo base_url();?>/admin/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

              
                  </ul>
               
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        <?php endif; ?>

        