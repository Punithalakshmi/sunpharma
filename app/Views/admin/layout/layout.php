<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sunpharma! Admin Panel </title>
    <!-- Bootstrap -->
     <?=link_tag('/vendors/bootstrap/dist/css/bootstrap.min.css');?>
    <!-- Font Awesome -->
    <?=link_tag('/vendors/font-awesome/css/font-awesome.min.css');?>
    <!-- NProgress -->
    <?=link_tag('/vendors/nprogress/nprogress.css');?>
       <!-- iCheck -->
    <?=link_tag('/vendors/iCheck/skins/flat/green.css');?>
    <!-- Datatables -->
    <?=link_tag('/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css');?>
    <?=link_tag('/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css');?>
    <?=link_tag('/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css');?>
    <?=link_tag('/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css');?>
    <?=link_tag('/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css');?>
    <!-- bootstrap-daterangepicker -->
    <?=link_tag('/vendors/bootstrap-daterangepicker/daterangepicker.css');?>
    <!-- bootstrap-datetimepicker -->
    <?=link_tag('/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css');?>
    <!-- Custom Theme Style -->
    <?=link_tag('/build/css/custom.min.css');?>
    <?=link_tag('/css/admin/custom-admin-iz.css');?>
      <script>
      var base_url = '<?=base_url();?>';
      </script>
  </head>

  <body class="nav-md">

  <div id="loader" class="lds-dual-ring hidden overlay"></div>
    <!-- Nav Part -->    
    <?= view('_partials/header'); ?>

    <!-- Content Section -->   
    <?=$content;?>

    <!-- Footer Menu -->
    <?= view('_partials/footer'); ?>

    </div>
    </div>

    <!-- jQuery -->
    <?= script_tag('/vendors/jquery/dist/jquery.min.js');?>
    <!-- Bootstrap -->
    <?= script_tag('/vendors/bootstrap/dist/js/bootstrap.min.js');?>
    
    <!-- FastClick -->
    <?= script_tag('/vendors/fastclick/lib/fastclick.js');?>
    <!-- NProgress -->
    <?= script_tag('/vendors/nprogress/nprogress.js');?>
    <!-- iCheck -->
    <?= script_tag('/vendors/iCheck/icheck.min.js');?>
    <!-- Datatables -->
    <?= script_tag('/vendors/datatables.net/js/jquery.dataTables.min.js');?>
   <?= script_tag('/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js');?>
   <?= script_tag('/vendors/datatables.net-buttons/js/dataTables.buttons.min.js');?>
   <?= script_tag('/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js');?>
   <?= script_tag('/vendors/datatables.net-buttons/js/buttons.flash.min.js');?>
   <?= script_tag('/vendors/datatables.net-buttons/js/buttons.html5.min.js');?>
   <?= script_tag('/vendors/datatables.net-buttons/js/buttons.print.min.js');?>
   <?= script_tag('/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js');?>
   <?= script_tag('/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js');?>
   <?= script_tag('/vendors/datatables.net-responsive/js/dataTables.responsive.min.js');?>
   <?= script_tag('/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js');?>
   <?= script_tag('/vendors/datatables.net-scroller/js/dataTables.scroller.min.js');?>
   <?= script_tag('/vendors/jszip/dist/jszip.min.js');?>
   <?= script_tag('/vendors/pdfmake/build/pdfmake.min.js');?>
   <?= script_tag('/vendors/pdfmake/build/vfs_fonts.js');?>

    <!-- bootstrap-daterangepicker -->
    <?= script_tag('/vendors/moment/min/moment.min.js');?>
    <?= script_tag('/vendors/bootstrap-daterangepicker/daterangepicker.js');?>
    <!-- bootstrap-datetimepicker -->    
    <?= script_tag('/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js');?>

    <!-- Custom Theme Scripts -->
    <?= script_tag('/build/js/custom.min.js');?>
	<?= script_tag('/js/admin/custom.js');?>
  </body>
</html>