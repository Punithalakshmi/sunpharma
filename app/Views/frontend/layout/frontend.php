<!DOCTYPE html>
<html lang="en">
<head>
     <meta name="google-site-verification" content="jK64bglNpSoN3kpoz00XKS0BDk1XyD9BB3OWAF89Gbw" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <?=csrf_meta();?>
    <title>Home - Sunpharma</title>
<meta name="description" content="Sun Pharma Science Foundation Research Awards 2023
Online Submission Of Nominations">

        <?=link_tag('frontend/assets/bootstrap/css/bootstrap.min.css')?>
        <?=link_tag('frontend/assets/bootstrap/css/datepicker.css')?>
        <?=link_tag('frontend/assets/css/bootstrap-msg.css')?>
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i,900,900i&amp;display=swap">
        <?=link_tag('frontend/assets/css/app.compiled.css')?>
        <?=link_tag('frontend/assets/css/auth-forms.compiled.css')?>
        <?=link_tag('frontend/assets/css/custom.css')?>
        <?=link_tag('frontend/assets/css/form.compiled.css')?>
        <?=link_tag('frontend/assets/css/Hero-Carousel-images.css')?>
        <?=link_tag('frontend/assets/css/swiperBundle.css')?>
        
        <?=link_tag('frontend/assets/css/innerPages.compiled.css')?>
        <?=link_tag('frontend/assets/css/responsive.compiled.css')?>
        <?=link_tag('frontend/assets/css/Simple-Slider-Simple-Slider.css')?>
        <?=link_tag('frontend/assets/css/slidingform.css')?>
        <?=link_tag('frontend/assets/css/datepickerMin.css')?>
       
    <script>
        var base_url = '<?=base_url();?>';
    </script>
    <?php $uri2 = $current_url->setSilent()->getSegment(2);
             if($uri2 !==''): ?>
        <script type="text/javascript">    
            var uri2     = '<?=$current_url->getSegment(2);?>';
        </script>
    <?php endif;?>
    <script src="<?=base_url();?>/frontend/assets/js/jquery.min.js"></script>
   
    <?= script_tag('frontend/assets/js/es6-shim.js'); ?>
  
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/formvalidation/0.6.2-dev/js/formValidation.min.js" integrity="sha512-DlXWqMPKer3hZZMFub5hMTfj9aMQTNDrf0P21WESBefJSwvJguz97HB007VuOEecCApSMf5SY7A7LkQwfGyVfg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/formvalidation/0.6.2-dev/js/framework/bootstrap.min.js" integrity="sha512-CwWsnPwntKMVNsVVCKIxPd4Ievk/YyAxt/yFNOLbs4JH3W6djpxYf2G50DtxLxFGHIbZxXeVDyjmTT8RCNp8DQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
   <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-LLXGS55DJH"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-LLXGS55DJH');
</script>

</head>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;padding-bottom: 0!important;" <?php if($uri && $uri == 'login'): ?> class="authBg" <?php endif;?> >

    <!-- Nav Part -->    
    <?= view('frontend/_partials/header'); ?>

    <!-- Content Section -->   
    <?=$content;?>

    <!-- Footer Menu -->
    <?= view('frontend/_partials/footer'); ?>

    <?= script_tag('frontend/assets/bootstrap/js/bootstrap.min.js'); ?>
    
    <?= script_tag('frontend/assets/js/bootstrap-msg.js');?>
    <?= script_tag('frontend/assets/js/jquery.confirmModal.min.js');?>
    <!-- FastClick -->
    <?= script_tag('frontend/assets/js/custom-app.js'); ?>
    <?= script_tag('frontend/assets/js/swiperBundle.js'); ?>

    <?php if(isset($uri) && $uri == 'ssan'): ?>
    <?= script_tag('frontend/assets/js/ssan.js'); ?>
    <?php endif; ?>
    <?php if(isset($uri) && $uri == 'spsfn'): ?>
        <?= script_tag('frontend/assets/js/spsfn.js'); ?>
    <?php endif; ?>
    <?php if(isset($uri) && $uri == 'fellowship'): ?>
        <?= script_tag('frontend/assets/js/fellowship.js'); ?>
    <?php endif; ?>
    <?= script_tag('frontend/assets/js/multi-item-carousel.js'); ?>
    <?= script_tag('frontend/assets/js/Simple-Slider.js'); ?>
    <?= script_tag('frontend/assets/js/sortTable.js'); ?>
    <?= script_tag('frontend/assets/js/static-forms.js');?>
    
</body>

</html>
