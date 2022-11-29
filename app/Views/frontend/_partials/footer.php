<?php if( $uri !='login'): ?>
<footer class="bg-primary-gradient" style="background: #5c5c5c;">
        <div class="container py-4 py-lg-5">
            <div class="row justify-content-center">
                <div class="col-sm-4 col-md-3 text-center text-lg-start d-flex flex-column item">
                    <h3 class="fs-6 fw-bold" style="color: #F7941E;">Home</h3>
                    <ul class="text-start" style="padding: 0 0 0 15px;">
                        <li style="color: var(--bs-white);font-size: 14px;"><a href="<?=base_url();?>" style="color: var(--bs-white);font-size: 14px;"><span style="color: var(--bs-white);">Forthcoming Events</span><br></a></li>
                        <li style="color: var(--bs-white);font-size: 14px;"><a href="<?=base_url();?>/directory_of_science_scholars" style="color: var(--bs-white);font-size: 14px;">Directory</a></li>
                        <li style="color: var(--bs-white);font-size: 14px;"><a href="<?=base_url();?>/contact" style="color: var(--bs-white);font-size: 14px;">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-sm-3 col-md-3 text-center text-lg-start d-flex flex-column item" style="font-size: 14px;">
                    <h3 class="fs-6 fw-bold" style="color: #F7941E;font-size: 14px;">About Us</h3>
                    <ul style="color: var(--bs-white);font-size: 14px;padding: 0 0 0 15px;text-align: left;">
                        <li style="color: var(--bs-white);font-size: 14px;"><a href="<?=base_url();?>/aboutus" style="color: var(--bs-white);font-size: 14px;">About SPSF</a></li>
                        <li style="color: var(--bs-white);font-size: 14px;"><a href="<?=base_url();?>/aboutus" style="color: var(--bs-white);font-size: 14px;">Mission statement</a></li>
                    </ul>
                </div>
                <div class="col-sm-2 col-md-2 text-center text-lg-start d-flex flex-column item" style="font-size: 14px;">
                    <h3 class="fs-6 fw-bold" style="color: #F7941E;font-size: 14px;">Awards</h3>
                    <ul style="color: var(--bs-white);font-size: 14px;text-align: left;padding: 0 0 0 15px;">
                        <li style="color: var(--bs-white);font-size: 14px;"><a href="<?=base_url();?>/research_awards" style="color: var(--bs-white);font-size: 14px;">Research Awards</a></li>
                        <li style="color: var(--bs-white);font-size: 14px;"><a href="<?=base_url();?>/science_scholar_awards" style="color: var(--bs-white);font-size: 14px;">Scholar Awards</a></li>
                    </ul>
                </div>
                <div class="col-sm-4 col-md-4 text-center text-lg-start d-flex flex-column item" style="font-size: 14px;">
                    <h3 class="fs-6 fw-bold" style="color: #F7941E;font-size: 14px;">Key Activities</h3>
                    <ul style="font-size: 14px;padding: 0 0 0 15px;text-align: left;">
                        <li style="font-size: 14px;color: var(--bs-gray-100);"><a href="<?=base_url();?>/symposium" style="color: var(--bs-white);font-size: 14px;">Scientific symposium in frontline areas of research</a></li>
                        <li style="font-size: 14px;color: var(--bs-white);"><a href="<?=base_url();?>/roundtable" style="color: var(--bs-white);font-size: 14px;">Round table conference on national health areas</a></li>
                        <li style="font-size: 14px;color: var(--bs-white);"><a href="<?=base_url();?>/annualforeign_scientist" style="color: var(--bs-white);font-size: 14px;">Inviting foreign scientists as visiting professor</a></li>
                        <li style="font-size: 14px;color: var(--bs-white);"><a href="<?=base_url();?>/special_awards" style="color: var(--bs-white);font-size: 14px;">Special Award in Public Health</a></li>
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
   
   