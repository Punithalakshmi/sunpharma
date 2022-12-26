<div class="container-fluid" style="padding: 0;">
        <div class="row gx-0 gy-0">
            <div class="col">

           
                <div class="carousel slide carousel-dark" data-bs-ride="carousel" id="carousel-1" style="height: 600px;">
                    <div class="carousel-inner h-100">
                    <?php  //echo "<pre>";
                            $current_date = strtotime(date("Y-m-d 23:59:59"));
                            if(is_array($nominations) && count($nominations) > 0): 
                                foreach($nominations as $nkey => $nvalue): 
                         
                                 $end_date = strtotime(date('Y-m-d',strtotime($nvalue['end_date'])));
                        ?>
                        <div class="carousel-item <?php if($nkey == 0):?>active<?php endif;?> h-100">
                            <img class="w-100 d-block position-absolute h-100 fit-cover" src="<?=base_url();?>/uploads/events/<?=$nvalue['banner_image'];?>" alt="Slide Image" style="z-index: -1;">
                            <div class="container text-start d-flex flex-column justify-content-center h-100">
                                <div class="row">
                                    <div class="col-md-8 col-xl-7 col-xxl-7 offset-md-0 banneroverlay" style="background: rgba(245,246,248,0.75);padding: 20px;border-radius: 6px;">
                                        <div class="bannercaption">
                                            <h1 class="text-uppercase fw-bold" style="border-style: none;"><?=(isset($nvalue['title']))?$nvalue['title']:"";?></h1>
                                            <p class="my-3"><?=(isset($nvalue['subject']))?$nvalue['subject']:"";?></p>
                                            <?php if(isset($nvalue['category_type']) && ($nvalue['category_type'] == 'awards' || $nvalue['category_type'] == 'awards') ):
                                                   $ntype = ($nvalue['main_category_id'] == 2)?'spsfn':'ssan';
                                                   if($end_date >= $current_date):
                                                ?>
                                             <a class="btn btn-primary btn-lg me-2" role="button" href="<?=base_url();?>/<?=$ntype;?>/<?=$nvalue['award_id']?>" style="background: #F7941E;border-color: #F7941E;">Submit Nomination</a>
                                            <?php endif; endif;?>  
                                            <?php if(isset($nvalue['type']) && ($nvalue['type'] == 'event') ):
                                                    

                                                     if($end_date >= $current_date):
                                                ?>
                                                     <a class="btn btn-primary btn-lg me-2" role="button" href="<?=base_url();?>/event/registration/<?=$nvalue['id'];?>" style="background: #F7941E;border-color: #F7941E;">Registration</a>
                                                     <?php endif;?>   
                                             <a class="btn btn-primary btn-lg me-2" role="button" href="<?=base_url();?>/event/read_more/<?=$nvalue['id'];?>" style="background: #F7941E;border-color: #F7941E;">Read More</a>

                                            <?php endif;?>  
                                            <?php if(!empty($nvalue['document'])):?>
                                            <a class="btn btn-outline-primary btn-lg" role="button" href="<?=base_url();?>/uploads/events/<?=$nvalue['document'];?>" target="blank">Poster Invitation</a>
                                            <?php endif;?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php  
                            endforeach;
                        else: ?>
                            <div class="carousel-item active h-100">
                            <img class="w-100 d-block position-absolute h-100 fit-cover" src="<?=base_url();?>/frontend/assets/img/slide4.jpg" alt="Slide Image" style="z-index: -1;">
                            <div class="container text-start d-flex flex-column justify-content-center h-100">
                               <!-- <div class="row">
                                    <div class="col-md-8 col-xl-7 col-xxl-7 offset-md-0 banneroverlay" style="background: rgba(245,246,248,0.75);padding: 20px;border-radius: 6px;">
                                        <div class="bannercaption">
                                            <h1 class="text-uppercase fw-bold" style="border-style: none;"><?//(isset($nvalue['title']))?$nvalue['title']:"";?></h1>
                                            <p class="my-3"></p>
                                             <a class="btn btn-primary btn-lg me-2" role="button" href="workshop-epidemiological-genomic-methods.html" style="background: #F7941E;border-color: #F7941E;">Read more</a> 
                                             <a class="btn btn-outline-primary btn-lg" role="button" href="<?//base_url();?>/uploads/events/<?//$nvalue['document'];?>" target="blank">Poster Invitation</a> 
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                        <?php
                            endif; ?>     
                    </div>
                    <div>
                        <a class="carousel-control-prev" href="#carousel-1" role="button" data-bs-slide="prev" style="filter: grayscale(0%);">
                            <span class="carousel-control-prev-icon"></span>
                            <span class="visually-hidden">Previous</span>
                       </a>
                        <a class="carousel-control-next" href="#carousel-1" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                        </div>
                        <ol class="carousel-indicators">
                         <?php  foreach($nominations as $nkey => $nvalue):  ?>
                            <li data-bs-target="#carousel-1" data-bs-slide-to="<?=$nkey;?>" class="active"></li>
                         <?php endforeach;?>   
                        </ol>
                </div>
           

            </div>
        </div>
    </div>
    <section style="padding: 35px 0px;background: #FBF9FE;">
        <div class="container py-4 py-xl-5">
            <div class="row gy-4 gy-md-0">
                <div class="col-md-6">
                    <div style="margin-right:15px;"><img class="rounded img-fluid w-100 fit-cover" style="min-height: 300px;" src="<?=base_url();?>/frontend/assets/img/about.jpg"></div>
                </div>
                <div class="col-md-6 d-md-flex align-items-md-center">
                    <div>
                        <h2 class="text-capitalize fw-normal" style="color: #F7941E;"><strong>About Us</strong></h2>
                        <p class="my-3" style="margin-bottom: 15px;">Sun Pharma Science Foundation is an independent non-profit organisation registered under the Societies Registration Act. The aim of the Foundation is to promote scientific endeavours in India by encouraging and rewarding excellence in medical and pharmaceutical sciences and to give impetus to research activity in India.</p><a class="btn btn-primary" role="button" href="<?=base_url();?>/aboutus">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="padding: 60px 0px 60px 0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h3 class="fw-bold heading" style="color: #F7941E;">Find out more</h3>
                </div>
            </div>
        </div>
        <div class="container">
	<div class="row">
		<div class="MultiCarousel" data-items="1,2,3,4" data-slide="1" id="MultiCarousel"  data-interval="1000">
            <div class="MultiCarousel-inner">
                <!-- slide 1 -->
                <div class="item">
                    <div class="card h-100 p-0" style="border: 1px solid #eaeaeb;">
                        <img class="card-img-top w-100 d-block fit-cover" src="<?=base_url();?>/frontend/assets/img/ResearchAwards-thumb.jpg" style="height: 200px;" alt="">
                        <div class="card-body p-4 pb-0">
                            <h4 class="card-title text-capitalize" style="color: var(--bs-blue);">Research Awards</h4>
                            <p class="card-text" style="font-size: 14px;">We invite Heads of Research Institutions, Universities, Medical and Pharmaceutical Colleges, to send in their nominations for the Sun Pharma Science Foundation Research Awards 2022.</p>
                            <a href="<?=base_url();?>/research_awards" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>

                <!-- slide 2 -->
                <div class="item">
                    <div class="card h-100 p-0" style="border: 1px solid #eaeaeb;">
                        <img class="card-img-top w-100 d-block fit-cover" src="<?=base_url();?>/frontend/assets/img/science-scholar-award-thumb.jpg" style="height: 200px;" alt="">
                        <div class="card-body p-4 pb-0">
                            <h4 class="card-title text-capitalize" style="color: var(--bs-blue);">Science Scholar Awards</h4>
                            <p class="card-text" style="font-size: 14px;">We invite Heads of Research Institutions, Universities, Medical and Pharmaceutical Colleges of India to nominate Young Scientists for the “Sun Pharma Science Foundation...</p>
                            <a href="<?=base_url();?>/science_scholar_awards" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>

                <!-- slide 3 -->
                <div class="item">
                    <div class="card h-100 p-0" style="border: 1px solid #eaeaeb;">
                        <img class="card-img-top w-100 d-block fit-cover" src="<?=base_url();?>/frontend/assets/img/round-table-thumb.jpg" style="height: 200px;" alt="">
                        <div class="card-body p-4 pb-0">
                            <h4 class="card-title text-capitalize" style="color: var(--bs-blue);">National Seminars</h4>
                            <p class="card-text" style="font-size: 14px;">The Foundation organizes two Round Table Conferences in a year on topics of contemporary concern to human health which pose challenges.</p>
                            <a href="<?=base_url();?>/roundtable" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>

                <!-- slide 4 -->
                <div class="item">
                    <div class="card h-100 p-0" style="border: 1px solid #eaeaeb;">
                        <img class="card-img-top w-100 d-block fit-cover" src="<?=base_url();?>/frontend/assets/img/symposia-thumb.jpg" style="height: 200px;" alt="">
                        <div class="card-body p-4 pb-0">
                            <h4 class="card-title text-capitalize" style="color: var(--bs-blue);">International Symposia</h4>
                            <p class="card-text" style="font-size: 14px;">The Foundation organizes one Annual Symposium on topics at the cutting edge of research in Medical Sciences to explore the latest research...</p>
                            <a href="<?=base_url();?>/symposium" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>

                <!-- slide 5 -->
                <div class="item">
                    <div class="card h-100 p-0" style="border: 1px solid #eaeaeb;">
                        <img class="card-img-top w-100 d-block fit-cover" src="<?=base_url();?>/frontend/assets/img/WorkshopYoungResearchers28Nov-Dec03-2022-thumb.jpg" style="height: 200px;" alt="">
                        <div class="card-body p-4 pb-0">
                            <h4 class="card-title text-capitalize" style="color: var(--bs-blue);">Workshop for the young researchers</h4>
                            <p class="card-text" style="font-size: 14px;">
                                This Winter School is being organized for clinical researchers and basic scientists engaged in research on biomedical sciences involving humans. 
                            </p>
                            <a href="<?=base_url();?>/event" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
               
            </div>
            <button class="border-0 leftLst">
<!--                 <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-left-circle-fill fs-3" style="color:var(--bs-gray-500);">
                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"></path>
                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"></path></svg> -->
                <svg xmlns='http://www.w3.org/2000/svg' width="2em" height="2em" viewBox='0 0 16 16' fill='#adb5bd'><path d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'/></svg>
            </button>
            <button class="border-0 rightLst">
                <svg xmlns='http://www.w3.org/2000/svg' width="2em" height="2em" viewBox='0 0 16 16' fill='#adb5bd'><path d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z'/></svg>
                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right-circle-fill fs-3" style="color:var(--bs-gray-500);">
                    <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"></path>
                </svg> -->

            </button>
        </div>
	</div>

	<!-- <div class="row">
	    <div class="col-md-12 text-center">
	        <br/><br/><br/>
	        <hr/>
	        <p>Settings</p>
	        <p>Change data items for xs,sm,md and lg display items respectively. Ex:data-items="1,3,5,6"</p>
	        <p>Change data slide for slides per click Ex:data-slide="1"</p>
	    </div>
	</div> -->
</div>
    </section>
     
    <section>
        <div class="container-fluid bg-primary-gradient py-5" style="padding: 48px 12px 0;">
            <div class="row">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h3 class="fw-bold heading" style="color: #F7941E;">Latest winners of Research awards</h3>
                </div>
            </div>
            <section class="pt-4 pt-xl-4">
                <div class="container">
                    <div class="simple-slider">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="bg-dark border rounded border-0 border-dark overflow-hidden" style="background: #5c5c5c!important;">
                                        <div class="row g-0">
                                            <div class="col-md-6 col-lg-8 winnercolleft">
                                                <div class="text-white winnerinfo">
                                                    <h2 class="fw-bold text-white mb-3">Dr. Kaustuv Sanyal</h2>
                                                    <p class="mb-4" style="color: var(--bs-gray-300);font-size: 13px;">Medical Sciences- Basic Research<br></p>
                                                    <p class="mb-4" style="color: var(--bs-btn-border-color);">JC Bose National Fellow<br>
Professor and Chair<br>
Molecular Biology and Genetics Unit
<br></p>
                                                    <div class="my-3"><a class="btn btn-primary me-2" role="button" href="<?=base_url();?>/latest_winners_of_research_awards">Know More</a></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4 order-first order-md-last winnercolright"><img class="w-100 h-100 fit-cover winnerimg" src="<?=base_url();?>/frontend/assets/img/Prof.-Kaustuv-Sanyal_Hi-Res-Photo[15].jpg"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="bg-dark border rounded border-0 border-dark overflow-hidden" style="background: #5c5c5c!important;">
                                        <div class="row g-0">
                                            <div class="col-md-6 col-lg-8 winnercolleft">
                                                <div class="text-white winnerinfo">
                                                    <h2 class="fw-bold text-white mb-3">Prof Sameer Bakhshi<br></h2>
                                                    <p class="mb-4" style="color: var(--bs-gray-300);font-size: 13px;">Medical Sciences- Clinical Research<br></p>
                                                    <p class="mb-4" style="color: var(--bs-btn-border-color);">Department of Medical Oncology<br>
Dr B.R.A. Institute Rotary Cancer Hospital<br>
All India Institute of Medical Sciences
<br></p>
                                                    <div class="my-3"><a class="btn btn-primary me-2" role="button" href="<?=base_url();?>/latest_winners_of_research_awards">Know More</a></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4 order-first order-md-last winnercolright"><img class="w-100 h-100 fit-cover winnerimg" src="<?=base_url();?>/frontend/assets/img/Prof.-Sameer-Bhakshi-Hi-Res-Photo[95].jpg"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="bg-dark border rounded border-0 border-dark overflow-hidden" style="background: #5c5c5c!important;">
                                        <div class="row g-0">
                                            <div class="col-md-6 col-lg-8 winnercolleft">
                                                <div class="text-white winnerinfo">
                                                    <h2 class="fw-bold text-white mb-3">Professor T. Govindaraju</h2>
                                                    <p class="mb-4" style="color: var(--bs-gray-300);font-size: 13px;">Pahrmaceutical Sciences<br></p>
                                                    <p class="mb-4" style="color: var(--bs-btn-border-color);">Bioorganic Chemistry Laboratory<br>   
New Chesmitry Unit, Jawaharlal Nehru Centre for<br> Advanced Scientific Research (JNCASR)
<br></p>
                                                    <div class="my-3"><a class="btn btn-primary me-2" role="button" href="<?=base_url();?>/latest_winners_of_research_awards">Know More</a></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4 order-first order-md-last winnercolright"><img class="w-100 h-100 fit-cover winnerimg" src="<?=base_url();?>/frontend/assets/img/Prof.-T.-Govindaraju[79].JPG"></div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="swiper-pagination bottom-0"></div>
                            <div class="text-light swiper-button-prev" style="margin: -25px 0px 0px;"></div>
                            <div class="text-light swiper-button-next" style="margin: -25px 0px 0px;"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <section></section>
    <section style="padding-top: 60px;">
        <div class="container-fluid">
            <div class="row" style="padding-bottom: 20px;">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h3 class="fw-bold heading" style="color: #F7941E;">Latest Winners of Scholars Awards</h3>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="simple-slider">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="bg-dark border rounded border-0 border-dark overflow-hidden" style="background: #5c5c5c!important;">
                                <div class="row g-0">
                                    <div class="col-sm-auto col-md-6 col-lg-8 winnercolleft">
                                        <div class="text-white winnerinfo">
                                            <h2 class="fw-bold text-white mb-3">Mr. Arjun B S</h2>
                                            <p class="mb-4" style="color: var(--bs-gray-300);font-size: 13px;">Biomedical Sciences<br></p>
                                            <p class="mb-4" style="color: var(--bs-btn-border-color);">(Ph.D. Scholar)<br>
Biomedical and Electronic Engineering Systems Laboratory<br>
Department of Electronic Systems Engineering
<br></p>
                                            <div class="my-3"><a class="btn btn-primary me-2" role="button" href="<?=base_url();?>/latest_winners_of_science_scholar_awards">Know More</a></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 order-first order-md-last winnercolright"><img class="w-100 h-100 fit-cover winnerimg" src="<?=base_url();?>/frontend/assets/img/Arjun-B-S.jpg"></div>
                                </div>
                            </div>
                        </div>
						
						<div class="swiper-slide">
                            <div class="bg-dark border rounded border-0 border-dark overflow-hidden" style="background: #5c5c5c!important;">
                                <div class="row g-0">
                                    <div class="col-sm-auto col-md-6 col-lg-8 winnercolleft">
                                        <div class="text-white winnerinfo">
                                            <h2 class="fw-bold text-white mb-3">Mr. Atish Roy Chowdhury</h2>
                                            <p class="mb-4" style="color: var(--bs-gray-300);font-size: 13px;">Biomedical Sciences<br></p>
                                            <p class="mb-4" style="color: var(--bs-btn-border-color);">Ph.D. Student<br>
Department of Microbiology and Cell Biology<br>
Indian Institute of Science
<br></p>
                                            <div class="my-3"><a class="btn btn-primary me-2" role="button" href="<?=base_url();?>/latest_winners_of_science_scholar_awards">Know More</a></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 order-first order-md-last winnercolright"><img class="w-100 h-100 fit-cover winnerimg" src="<?=base_url();?>/frontend/assets/img/Atish-Roy-Chowdhury-SSA-2022.jpg"></div>
                                </div>
                            </div>
                        </div>
						
                        <div class="swiper-slide">
                            <div class="bg-dark border rounded border-0 border-dark overflow-hidden" style="background: #5c5c5c!important;">
                                <div class="row g-0">
                                    <div class="col-md-6 col-lg-8 winnercolleft">
                                        <div class="text-white winnerinfo">
                                            <h2 class="fw-bold text-white mb-3">Mr. Deepak Kumar Sahel</h2>
                                            <p class="mb-4" style="color: var(--bs-gray-300);font-size: 13px;">Pharmaceutical Sciences <br></p>
                                            <p class="mb-4" style="color: var(--bs-btn-border-color);">Ph.D. Research Scholar<br>
ICMR-Senior Research Fellow (SRF)<br>
Nanomedicine & Gene Delivery Lab
<br></p>
                                            <div class="my-3"><a class="btn btn-primary me-2" role="button" href="<?=base_url();?>/latest_winners_of_science_scholar_awards">Know More</a></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 order-first order-md-last winnercolright"><img class="w-100 h-100 fit-cover winnerimg" src="<?=base_url();?>/frontend/assets/img/Deepak-Kumar-Sahel.jpg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="bg-dark border rounded border-0 border-dark overflow-hidden" style="background: #5c5c5c!important;">
                                <div class="row g-0">
                                    <div class="col-md-6 col-lg-8 winnercolleft">
                                        <div class="text-white winnerinfo">
                                            <h2 class="fw-bold text-white mb-3">Ms. Rachana Rao Battaje</h2>
                                            <p class="mb-4" style="color: var(--bs-gray-300);font-size: 13px;">Pharmaceutical Sciences<br></p>
                                            <p class="mb-4" style="color: var(--bs-btn-border-color);">Ph. D. Candidate<br>
Molecular Cell Biology Lab,<br>
C/O Prof. Dulal Panda
<br></p>
                                            <div class="my-3"><a class="btn btn-primary me-2" role="button" href="<?=base_url();?>/latest_winners_of_science_scholar_awards">Know More</a></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 order-first order-md-last winnercolright"><img class="w-100 h-100 fit-cover winnerimg" src="<?=base_url();?>/frontend/assets/img/Rachana-Rao-Battaje[26].jpg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination bottom-0"></div>
                    <div class="text-light swiper-button-prev" style="margin: -24px 0px 0px;"></div>
                    <div class="text-light swiper-button-next" style="margin: -24px 0px 0px;"></div>
                </div>
            </div>
        </div>
    </section>
  
    <section style="margin:60px 0;">
        <div class="row mx-0">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h3 class="fw-bold heading" style="color: #F7941E;">Social Media</h3>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 feedcol"><blockquote class="twitter-tweet"><p lang="en" dir="ltr">We’re happy to invite entries for excellence in original research work in medical and pharmaceutical sciences from scientists and young researchers. Nominations for Sun Pharma Science Foundation Awards 2022 are open.<br><br>Visit : <a href="https://t.co/ZwJD0o1XPi">https://t.co/ZwJD0o1XPi</a><a href="https://twitter.com/hashtag/SPSF?src=hash&amp;ref_src=twsrc%5Etfw">#SPSF</a> <a href="https://twitter.com/hashtag/Awards?src=hash&amp;ref_src=twsrc%5Etfw">#Awards</a> <a href="https://twitter.com/hashtag/SunPharma?src=hash&amp;ref_src=twsrc%5Etfw">#SunPharma</a> <a href="https://t.co/1OK9VbhWCY">pic.twitter.com/1OK9VbhWCY</a></p>&mdash; Sun Pharma (@SunPharma_Live) <a href="https://twitter.com/SunPharma_Live/status/1552551634525618176?ref_src=twsrc%5Etfw">July 28, 2022</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></div>
                <div class="col-12 col-sm-12 col-md-4 feedcol"><blockquote class="twitter-tweet"><p lang="en" dir="ltr">Join us for the Sun Pharma Science Foundation’s Annual Conference on 25th April from 9 AM to 4 PM. <br><br>Watch : <a href="https://t.co/KGA9aimQkA">https://t.co/KGA9aimQkA</a> <br>Passcode: 12345 <br><br>Register : <a href="https://t.co/mm3CQNXvjw">https://t.co/mm3CQNXvjw</a><a href="https://twitter.com/hashtag/SunPharma?src=hash&amp;ref_src=twsrc%5Etfw">#SunPharma</a> <a href="https://twitter.com/hashtag/ScienceFoundationAnnualConference?src=hash&amp;ref_src=twsrc%5Etfw">#ScienceFoundationAnnualConference</a> <a href="https://t.co/Vy0ymSbozG">pic.twitter.com/Vy0ymSbozG</a></p>&mdash; Sun Pharma (@SunPharma_Live) <a href="https://twitter.com/SunPharma_Live/status/1517813409425018882?ref_src=twsrc%5Etfw">April 23, 2022</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></div>
                <div class="col-12 col-sm-12 col-md-4 feedcol"><blockquote class="twitter-tweet"><p lang="en" dir="ltr">Heartiest congratulations to the winners of the Sun Pharma Science Foundation Science Scholar Award - 2021 for outstanding research works. The award promotes scientific endeavours in India by encouraging young researchers who are contributing to the future advancement of science. <a href="https://t.co/zb3a3Wj3oW">pic.twitter.com/zb3a3Wj3oW</a></p>&mdash; Sun Pharma (@SunPharma_Live) <a href="https://twitter.com/SunPharma_Live/status/1484718211140825095?ref_src=twsrc%5Etfw">January 22, 2022</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></div>
            </div>
        </div>
        <div class="container">
            <div></div>
        </div>
    </section>
        

      