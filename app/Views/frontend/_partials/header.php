


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
                                <a class="dropdown-item" href="<?=base_url();?>/latest_winners_of_research_awards">Latest Winners Of Research Awards<br></a>
                                <a class="dropdown-item" href="<?=base_url();?>/science_scholar_awards">Scholar Awards</a>
                                <a class="dropdown-item" href="<?=base_url();?>/latest_winners_of_science_scholar_awards">Latest Winners Of Scholar Awards</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-item dropdown nav-link">
                            <a class="dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" href="<?=base_url();?>/symposium">Key Activities</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?=base_url();?>/symposium">Scientific Symposium</a>
                                <a class="dropdown-item" href="<?=base_url();?>/roundtable">National Seminar</a>
                                <a class="dropdown-item" href="<?=base_url();?>/annualforeign_scientist">Inviting Foreign Scientists</a>
                                <a class="dropdown-item" href="<?=base_url();?>/special_awards">Special Award In Public Health</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-item dropdown nav-link">
                            <a class="dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" href="<?=base_url();?>/directory_research_awardees">Directory</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?=base_url();?>/directory_research_awardees">Directory - Research Award Winners</a>
                                <a class="dropdown-item" href="<?=base_url();?>/directory_of_science_scholars">Directory - Science Scholars</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?=base_url();?>/contact">Contact Us</a></li>
                </ul>
                <?php //if(!isset($userdata['isLoggedIn'])):?>
                    <!--<a class="btn btn-primary shadow" role="button" href="<?=base_url();?>/login">Login</a>-->
                <?php //else: ?>
                    <!--<a class="btn btn-primary shadow" role="button" href="<?=base_url();?>/logout">Logout</a>-->
                <?php //endif;?>
            </div>
        </div>
    </nav>
    <?php endif;?>