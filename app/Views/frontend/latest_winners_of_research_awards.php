
    <section class="heroInner" style="background: url(&quot;<?=base_url();?>/frontend/assets/img/research-awards.jpg&quot;) center left no-repeat, #fff;">
        <div class="container">
            <h1 class="fs-1 fw-bold text-capitalize fw-normal p-3 m-0 d-inline-block" style="color: var(--theme-orange);">Latest Winners Research Award<br></h1>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12"></div>
            </div>
        </div>
        <div class="container" style="margin-bottom: 60px;">
            <div class="row">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h3 class="heading" style="color: #F7941E;">Sun Pharma Science Foundation Research Awardees - <?=date("Y");?></h3>
                </div>
            </div>
            <div class="row row-cols-2 row-cols-md-2 mx-auto" style="max-width: 900px;">
            <?php if(is_array($latestWinnersOfResearchAwards) && count($latestWinnersOfResearchAwards) > 0):
                   foreach($latestWinnersOfResearchAwards as $rkey => $rvalue): ?>
                <div class="col mb-4">
                    <div class="text-center"><a href="#" data-bs-target="#SuvendraNathBhattacharyya" data-bs-toggle="modal"><img class="rounded mb-3 fit-cover" width="150" height="150" src="<?=base_url();?>/uploads/<?=$rvalue['id'];?>/<?=$rvalue['nominator_photo'];?>"></a>
                       <a href="#" data-bs-target="#SuvendraNathBhattacharyya" data-bs-toggle="modal">
                            <h5 class="fw-bold mb-0"><?=$rvalue['firstname'];?><br></h5>
                        </a>
                        <p class="text-muted mb-2"><?=$rvalue['category_name'];?></p>
                        <p class="text-muted mb-2"></p>
                    </div>
                </div>
            <?php endforeach;
                  endif; ?>    
                <!-- <div class="col mb-4">
                    <div class="text-center"><a href="#" data-bs-target="#BushraAteeq" data-bs-toggle="modal"><img class="rounded mb-3 fit-cover" width="150" height="150" src="<?=base_url();?>/frontend/assets/img/BushraAteeq-photo.jpg"></a><a href="#" data-bs-target="#BushraAteeq" data-bs-toggle="modal">
                            <h5 class="fw-bold mb-0">Professor Bushra Ateeq<br></h5>
                        </a>
                        <p class="text-muted mb-2">Medical Sciences- Basic Research</p>
                        <p class="text-muted mb-2"></p>
                    </div>
                </div>
                <div class="col mb-4">
                    <div class="text-center"><a href="#" data-bs-target="#GirirajRatanChandak" data-bs-toggle="modal"><img class="rounded mb-3 fit-cover" width="150" height="150" src="<?=base_url();?>/frontend/assets/img/GirirajRattanChandak-photo.jpg"></a><a href="#" data-bs-target="#GirirajRatanChandak" data-bs-toggle="modal">
                            <h5 class="fw-bold mb-0">Dr Giriraj Ratan Chandak<br></h5>
                        </a>
                        <p class="text-muted mb-2">Medical Sciences- Clinical Research<br></p>
                        <p class="text-muted mb-2"></p>
                    </div>
                </div>
                <div class="col mb-4">
                    <div class="text-center"><a href="#" data-bs-target="#DebabrataMaiti" data-bs-toggle="modal"><img class="rounded mb-3 fit-cover" width="150" height="150" src="<?=base_url();?>/frontend/assets/img/DebabrataMaiti-photo.jpg"></a><a href="#" data-bs-target="#DebabrataMaiti" data-bs-toggle="modal">
                            <h5 class="fw-bold mb-0">Prof. Debabrata Maiti<br></h5>
                        </a>
                        <p class="text-muted mb-2">Pharmaceutical Sciences<br></p>
                        <p class="text-muted mb-2"></p>
                    </div>
                </div> -->
            </div>
        </div>
    </section>

    <div class="modal fade" role="dialog" tabindex="-1" id="SuvendraNathBhattacharyya">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Dr Suvendra Nath Bhattacharyya<br></h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-6 col-lg-3"><img class="img-fluid mb-3 fit-cover rounded-3" src="<?=base_url();?>/frontend/assets/img/SuvendraNathBhattacharyya-photo.jpg" style="width: 150px;height: 150px;"></div>
                            <div class="col-md-6 col-lg-9">
                                <p class="fw-bold">Dr Suvendra Nath Bhattacharyya<br></p><small>Senior Principal Scientist and Head,<br>Molecular Genetics Division,<br>CSIR-Indian Institute of Chemical biology,<br>Kolkata, India<br>Twitter: Suvendra Bhattacharyya(@Suvendra_B)<br><br></small>
                            </div>
                        </div>
                    </div>
                    <div class="text-start"></div>
                    <p>Dr Suvendra Nath Bhattacharyya has been awarded The Sun Pharma Science Foundation Research Award in Medical Sciences (Basic Research) for his seminal contribution in establishing the role of a special class of small regulatory RNAs, the microRNAs, in varieties of cellular events and pathways in mammalian cells including the host-pathogen interaction and infection processes. Dr Bhattacharyya has investigated the mechanism of exchange of microRNAs between mammalian cells via the Extracellular Vesicles (EV) and has shown importance of EV-associated miRNA exchange in neurodegeneration, inflammation, and cancer. He has recently explored the EV-associated microRNAs as immunomodulators to regulate the infection process of the host cells by the invading pathogen Leishmania donovani, the causative agent of visceral leishmaniasis. His research also promises development of microRNA and EV-based therapeutics against other deadly diseases.<br></p>
                </div>
                <div class="modal-footer"><button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>


    <div class="modal fade" role="dialog" tabindex="-1" id="BushraAteeq">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Professor Bushra Ateeq<br></h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-6 col-lg-3"><img class="img-fluid mb-3 fit-cover rounded-3" src="<?=base_url();?>/frontend/assets/img/BushraAteeq-photo.jpg" style="width: 150px;height: 150px;"></div>
                            <div class="col-md-6 col-lg-9">
                                <p class="fw-bold">Professor Bushra Ateeq<br></p><small>Department of Biological Sciences and<br>Bioengineering,<br>Indian Institute of Technology Kanpur<br>Kanpur, 208016, U.P., India<br>Twitter @bushraiitk<br></small>
                            </div>
                        </div>
                    </div>
                    <div class="text-start"></div>
                    <p>Professor Bushra Ateeq has been awarded The Sun Pharma Science Foundation Research Award in Medical Sciences (Basic Research) for molecular characterization of prostate cancer with application in diagnostics and precision medicine, discovery of new drug targets and development of alternative therapeutic strategies for the treatment of advanced-stage and drug-resistant cancer.<br></p>
                </div>
                <div class="modal-footer"><button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="GirirajRatanChandak">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Dr Giriraj Ratan Chandak<br></h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-6 col-lg-3"><img class="img-fluid mb-3 fit-cover rounded-3" src="<?=base_url();?>/frontend/assets/img/GirirajRattanChandak-photo.jpg" style="width: 150px;height: 150px;"></div>
                            <div class="col-md-6 col-lg-9">
                                <p class="fw-bold">Dr Giriraj Ratan Chandak<br></p><small>Chief Scientist &amp; Group Leader<br>CSIR-Centre for Cellular and Molecular Biology<br>Hyderabad - 500007<br>Twitter : 'chandakgrc'<br></small>
                            </div>
                        </div>
                    </div>
                    <div class="text-start"></div>
                    <p>Dr Giriraj Ratan Chandak, a physician-scientist has made significant contributions in the field of genetic disorders. A former director of the Centre for DNA Fingerprinting and Diagnostics, he has led multiple cohort-based studies of non-communicable diseases. He has discovered novel genes for chronic pancreatitis demonstrating genetic heterogeneity with Europeans. He lead his team to identify a novel microRNA that regulates Type 2 diabetes risk genes through vitamin B12, proving that genetic susceptibility to Type 2 diabetes and associated intermediate traits like obesity and insulin resistance may be epigenetically regulated. In contrast to the global role of folate deficiency, he has established maternal B12 deficiency as a risk factor for neural tube defects in their children. These findings have immense translational value. As Director of CSIR-Sickle Cell Anaemia Mission, he is passionately involved in creating awareness and reducing the disease burden through population screening, prenatal diagnosis, and clinical, social and genetic counseling.<br></p>
                </div>
                <div class="modal-footer"><button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="DebabrataMaiti">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Prof. Debabrata Maiti<br></h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-6 col-lg-3"><img class="img-fluid mb-3 fit-cover rounded-3" src="<?=base_url();?>/frontend/assets/img/DebabrataMaiti-photo.jpg" style="width: 150px;height: 150px;"></div>
                            <div class="col-md-6 col-lg-9">
                                <p class="fw-bold">Prof. Debabrata Maiti<br></p><small>Department of Chemistry<br>Indian Institute of Technology Bombay<br>Powai, Mumbai 400076, India<br>Twitter : Debabrata Maiti (@maiti_iitb)<br></small>
                            </div>
                        </div>
                    </div>
                    <div class="text-start"></div>
                    <p>Prof. Debabrata Maiti has been selected as the recipient of The Sun Pharma Science Foundation Research Award 2021 in Pharmaceutical Sciences. He has established himself as one of the world’s leading scientists in the field of C-H activation by designing innovative catalytic methods for transforming organic molecules into several bio-active natural products as well as drug molecules and materials in step and atom-economic fashion. These conceptual developments have witnessed significant impact on materials research, agrochemicals and pharmaceuticals industry. At the same time, he has successfully developed various bio-inspired approaches by employing “eco-friendly” metals. In recent times, his group is pursuing research in the field of artificial metalloenzymatic chemistry, which has seen tremendous growth with significant value in agrochemical and pharmaceutical industries.<br></p>
                </div>
                <div class="modal-footer"><button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>