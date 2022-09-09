<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sun Pharma Science Foundation </title>
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url();?>/frontend/assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url();?>/frontend/assets/images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url();?>/frontend/assets/images/favicons/favicon-16x16.png" />
    <link rel="manifest" href="<?=base_url();?>/frontend/assets/images/favicons/site.webmanifest" />
    <meta name="description" content="Insur HTML 5 Template " />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/vendors/animate/animate.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/vendors/animate/custom-animate.css" />
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/vendors/jarallax/jarallax.css" />
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css" />
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/vendors/nouislider/nouislider.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/vendors/nouislider/nouislider.pips.css" />
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/vendors/odometer/odometer.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/vendors/swiper/swiper.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/vendors/insur-icons/style.css">
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/vendors/tiny-slider/tiny-slider.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/vendors/reey-font/stylesheet.css" />
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/vendors/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/vendors/owl-carousel/owl.theme.default.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/vendors/bxslider/jquery.bxslider.css" />
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/vendors/bootstrap-select/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/vendors/vegas/vegas.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/vendors/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/vendors/timepicker/timePicker.css" />

    <!-- template styles -->
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/css/insur.css" />
    <link rel="stylesheet" href="<?=base_url();?>/frontend/assets/css/insur-responsive.css" />
    <style type="text/css">
        div#newslider {
            margin-top: 20px;
        }

        div#newslider .alert {
            background: #fcc89b2e;
        }
    </style>
</head>
<body>

    <div class="preloader">
        <div class="preloader__image"></div>
    </div>
    <!-- /.preloader -->


    <div class="page-wrapper">
        <header class="main-header-two clearfix">
            <div class="main-header-two__top">
                <div class="main-header-two__top-social-box">
             
                    <div class="container">
                        <div class="main-header-two__top-social-box-inner">
                            <p class="main-header-two__top-social-text"> <i class="fa fa-pin"></i> <span>Address:</span> 8C, 8th Floor, Hansalaya Building, 15-Barakhamba Road, Connaught Place, New Delhi -110001, INDIA</p>
                            <?php if(!is_array($userdata)):?>
                              <div class="main-header-two__top-menu-box">
                                    <ul class="list-unstyled main-header-two__top-menu">
                                        <li><a href="<?=base_url();?>/login"><u>Login</u></a></li>
                                    </ul>
                                </div>
                            <?php else: ?>
                                <div class="main-header-two__top-menu-box">
                                    <ul class="list-unstyled main-header-two__top-menu">
                                        <li><a href="<?=base_url();?>/logout"><u>Logout</u></a></li>
                                    </ul>
                                </div> 
                            <?php endif;?>  
                        </div>
                    </div>
                </div>
                <div class="main-header-two__top-details">
                    <div class="container">
                        <div class="main-header-two__top-details-inner">
                            <div class="main-header-two__logo">
                                <a href="<?=base_url();?>"><img src="<?=base_url();?>/frontend/assets/images/logo-2-alt.png" alt="Sun Pharma Science Foundation"></a>
                            </div>
                            <ul class="list-unstyled main-header-two__top-details-list">
                                <li>
                                    <div class="icon">
                                        <span class="icon-email"></span>
                                    </div>
                                    <div class="text">
                                        <h5>Email Us</h5>
                                        <p><a href="mailto:sunpharma.sciencefoundation@sunpharma.com">sunpharma.sciencefoundation@sunpharma.com</a></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <span class="icon-telephone-call"></span>
                                    </div>
                                    <div class="text">
                                        <h5>Call for help</h5>
                                        <p><a href="tel:+91 - (11) - 23721414">+91 - (11) - 23721414</a></p>
                                    </div>
                                </li>
                                <!-- <li>
                                    <div class="icon">
                                        <span class="icon-pin"></span>
                                    </div>
                                    <div class="text">
                                        <h5>SUN PHARMA SCIENCE FOUNDATION,</h5>
                                        <p>8C, 8th Floor, Hansalaya Building, 15-Barakhamba Road, Connaught Place, New Delhi -110001, INDIA</p>
                                    </div>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="main-menu main-menu-two clearfix">
                <div class="main-menu-two__wrapper clearfix">
                    <div class="container">
                        <div class="main-menu-two__wrapper-inner clearfix">
                            <div class="main-menu-two__left">
                                <div class="main-menu-two__main-menu-box">
                                    <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                                    <ul class="main-menu__list">
                                        <li>
                                            <a href="/mission">Mission</a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="/research_awards">Research Awards</a>
                                            <ul>
                                                <li><a href="/research_awards">Latest Winners of Research Awards</a></li>
                                                <li><a href="/directory_research_awardees">Directory of Research Awardees</a></li>
                                            </ul>
                                        </li>

                                        <li class="dropdown">
                                            <a href="/latest_winners_of_science_scholars_awards">Scholars Awards</a>
                                            <ul>
                                                <li><a href="/latest_winners_of_science_scholars_awards">Latest Winners of Science Scholars Awards</a></li>
                                                <li><a href="/directory_of_science_scholars">Directory of Science Scholars</a></li>
                                                <!-- <li><a href="#">Science Scholars Awards for Young Scientists</a></li> -->
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="/annual_activities">Annual Activities</a>
                                            <!-- <ul>    
                                                <li><a href="#">Upcoming Events</a></li>                                           </li>
                                                <li><a href="#">Research work by Indian scientists</a></li>
                                                <li><a href="#">Scientific symposium</a></li>
                                                <li><a href="#">Round table conference</a></li>
                                                <li><a href="#">Inviting foreign scientist</a></li>
                                            </ul> -->
                                        </li>
                                       
                                        <li>
                                            <a href="/special_awards">Special Award in Public Health</a>
                                        </li>
                                        
                                        <li>
                                            <a href="/contact">Contact</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="main-menu-two__right">
                                <div class="main-menu-two__search-box-get-quote">
                                  
                                    <!-- <div class="main-menu-two__get-quote">
                                        
                                     <ul class="main-menu__list">   
                                        <li class="dropdown megamenu">
                                        <a href="/ssan" class="thm-btn main-menu-two__get-quote-btn">Submit Nomination</a>
                                            <ul>
                                                <li><a class="researchaward" href="/spsfn">Sun Pharma Science Foundation Research Awards 2022</a></li>
                                                <li><a class="schaward" href="/ssan">Sun Pharma Science Foundation Science Scholar Awards 2022</a></li>
                                            </ul>
                                        </li></ul></div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="stricky-header stricked-menu main-menu main-menu-two">
            <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
        </div><!-- /.stricky-header -->

        