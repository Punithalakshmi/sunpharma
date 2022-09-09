<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sunpharma! </title>

    
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url();?>/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo base_url();?>/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url();?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="<?php echo base_url();?>/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>/build/css/custom.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>/css/admin/custom-admin-iz.css" rel="stylesheet">
    <script>
      var base_url = '<?=base_url();?>';
      </script>
      
  </head>

  <body class="nav-md">
  <?php if(is_array($userdata)): ?>
    <div class="container body">

      <div class="main_container">
        
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
              <a href="/admin" class="site_title"><img class="logo img-responsive" src="<?php echo base_url();?>/images/logo.jpg" alt="Sun Pharma Science Foundation" /></a>
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
                    <i class="fa fa-user"></i> Nominees </a>
                  </li>
                  <li><a href="<?php echo base_url();?>/admin/category">
                    <i class="fa fa-user"></i> Categories </a>
                  </li>
                  <li><a href="<?php echo base_url();?>/admin/nomination">
                    <i class="fa fa-user"></i> Nominations </a>
                  </li>
                  <?php } else if($userdata['role'] == 1){ ?>
                    <li><a href="<?php echo base_url();?>/admin/nominee/lists">
                      <i class="fa fa-user"></i> Nominees </a>
                    </li>
                    <!-- <li><a href="<?php //echo base_url();?>/admin/nominee/ratings">
                      <i class="fa fa-user"></i> Rated Nominees </a>
                  </li> -->
                  <?php }else{}?>
                </ul>
              </div>
              

            </div>
            <!-- /sidebar menu -->

           
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
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo base_url();?>/admin/profile"> Profile</a></li>
                    <li><a href="<?php echo base_url();?>/admin/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

              
                  </ul>
               
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        <?php endif; ?>