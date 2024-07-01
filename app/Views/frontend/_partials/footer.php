<?php if( $uri !='login'): ?>
<footer class="bg-primary-gradient" style="background: #5c5c5c;">
        <div class="container py-4 py-lg-5">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-3 text-center text-lg-start d-flex flex-column item">
                    <h3 class="fs-6 fw-bold" style="color: #F7941E;">Home</h3>
                    <ul class="text-start" style="padding: 0 0 0 15px;">
                        <li style="color: var(--bs-white);font-size: 14px;"><a href="<?=base_url();?>" style="color: var(--bs-white);font-size: 14px;"><span style="color: var(--bs-white);">Forthcoming Events</span><br></a></li>
                        <li style="color: var(--bs-white);font-size: 14px;"><a href="<?=base_url();?>/directory_of_science_scholars" style="color: var(--bs-white);font-size: 14px;">Directory</a></li>
                        <li style="color: var(--bs-white);font-size: 14px;"><a href="<?=base_url();?>/contact" style="color: var(--bs-white);font-size: 14px;">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-2 text-center text-lg-start d-flex flex-column item" style="font-size: 14px;">
                    <h3 class="fs-6 fw-bold" style="color: #F7941E;font-size: 14px;">About Us</h3>
                    <ul style="color: var(--bs-white);font-size: 14px;padding: 0 0 0 15px;text-align: left;">
                        <li style="color: var(--bs-white);font-size: 14px;"><a href="<?=base_url();?>/aboutus" style="color: var(--bs-white);font-size: 14px;">About SPSF</a></li>
                        <li style="color: var(--bs-white);font-size: 14px;"><a href="<?=base_url();?>/aboutus" style="color: var(--bs-white);font-size: 14px;">Mission Statement</a></li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-3 text-center text-lg-start d-flex flex-column item" style="font-size: 14px;">
                    <h3 class="fs-6 fw-bold" style="color: #F7941E;font-size: 14px;">Fellowships</h3>
                    <ul style="color: var(--bs-white);font-size: 14px;text-align: left;padding: 0 0 0 15px;">

                    <li style="color: var(--bs-white);font-size: 14px;"><a class="dropdown-item" href="<?=base_url();?>/research_awards">Research Fellowships</a></li>
                    <li style="color: var(--bs-white);font-size: 14px;"><a class="dropdown-item" href="<?=base_url();?>/latest_winners_of_research_awards">Latest Winners Of Research Fellowships<br></a></li>
                    <li style="color: var(--bs-white);font-size: 14px;"><a class="dropdown-item" href="<?=base_url();?>/science_scholar_awards">Scholar Fellowships</a></li>
                    <li style="color: var(--bs-white);font-size: 14px;"><a class="dropdown-item" href="<?=base_url();?>/latest_winners_of_science_scholar_awards">Latest Winners Of Scholar Fellowships</a></li>

                    </ul>
                </div>
                <div class="col-sm-12 col-md-4 text-center text-lg-start d-flex flex-column item" style="font-size: 14px;">
                    <h3 class="fs-6 fw-bold" style="color: #F7941E;font-size: 14px;">Key Activities</h3>
                    <ul style="font-size: 14px;padding: 0 0 0 15px;text-align: left;">

                    <li style="font-size: 14px;color: var(--bs-gray-100);"><a class="dropdown-item" href="<?=base_url();?>/symposium">Scientific Symposium</a></li>
                    <li style="font-size: 14px;color: var(--bs-gray-100);"><a class="dropdown-item" href="<?=base_url();?>/roundtable">National Seminar</a></li>
                    <li style="font-size: 14px;color: var(--bs-gray-100);"><a class="dropdown-item" href="<?=base_url();?>/annualforeign_scientist">Inviting Foreign Scientists</a></li>
                    <li style="font-size: 14px;color: var(--bs-gray-100);"><a class="dropdown-item" href="<?=base_url();?>/special_awards">Special Fellowship In Public Health</a></li>
                  </ul>
                </div>
            </div>
            <hr>
            <div class="text-muted d-flex justify-content-between align-items-center pt-3">
                <p class="mb-0" style="color: var(--bs-gray-400);font-size: 13px;">Copyright © <?=date("Y");?> Sun Pharma Science Foundation.</p>
            </div>
        </div>
    </footer>
    <?php endif;?>
   
   