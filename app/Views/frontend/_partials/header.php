<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Sunpharma</title>
<meta name="description" content="Sun Pharma Science Foundation Research Awards 2022
Online Submission Of Nominations">
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/css/app.compiled.css">
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/css/auth-forms.compiled.css">
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/css/custom.css">
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/css/form.compiled.css">
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/css/Hero-Carousel-images.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/css/innerPages.compiled.css">
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/css/Simple-Slider-Simple-Slider.css">
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/css/slidingform.css">
    <script>
        var base_url = '<?=base_url();?>';
    </script>
    <script src="<?=base_url();?>/frontend/assets/js/jquery.min.js"></script>
</head>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;padding-bottom: 0!important;" 

<?php if($uri && $uri == 'login'): ?> class="authBg" <?php endif;?> >

<div id="overlay">
  <div class="cv-spinner">
    <span class="spinner"></span>
  </div>
</div>
  <?php if( $uri !='login'): ?>
    
    <nav class="navbar navbar-light navbar-expand-lg sticky-top" id="mainNav" style="padding: 0;">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="<?=base_url();?>"><span>
            <img src="<?=base_url();?>/frontend/assets/img/logo-dark.svg" height="120" style="object-fit: cover;"></span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="<?=base_url();?>/aboutus">About Us</a></li>
                    <li class="nav-item">
                        <div class="nav-item dropdown nav-link">
                            <a class="dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" href="<?=base_url();?>/research_awards">Awards</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?=base_url();?>/research_awards">Research Awards</a>
                                <a class="dropdown-item" href="<?=base_url();?>/latest_winners_of_research_awards">Latest winners of Research awards<br></a>
                                <a class="dropdown-item" href="<?=base_url();?>/science_scholar_awards">Scholar Awards</a>
                                <a class="dropdown-item" href="<?=base_url();?>/latest_winners_of_science_scholar_awards">Latest winners of Scholar awards</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-item dropdown nav-link">
                            <a class="dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" href="<?=base_url();?>/symposium">Key Activities</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?=base_url();?>/symposium">Scientific symposium in frontline areas of research</a>
                                <a class="dropdown-item" href="<?=base_url();?>/roundtable">Round table conference on national health areas</a>
                                <a class="dropdown-item" href="<?=base_url();?>/annualforeign_scientist">Inviting foreign scientists as visiting professor</a>
                                <a class="dropdown-item" href="<?=base_url();?>/special_awards">Special Award in Public Health</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-item dropdown nav-link">
                            <a class="dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" href="<?=base_url();?>/directory_research_awardees">Directory</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?=base_url();?>/directory_research_awardees">Directory - Research Award winners</a>
                                <a class="dropdown-item" href="<?=base_url();?>/directory_of_science_scholars">Directory - Science Scholars</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?=base_url();?>/contact">Contact Us</a></li>
                </ul>
                <?php if(!isset($userdata['isLoggedIn'])):?>
                    <a class="btn btn-primary shadow" role="button" href="<?=base_url();?>/login">Login</a>
                <?php else: ?>
                    <a class="btn btn-primary shadow" role="button" href="<?=base_url();?>/logout">Logout</a>
                <?php endif;?>
            </div>
        </div>
    </nav>
    <?php endif;?>