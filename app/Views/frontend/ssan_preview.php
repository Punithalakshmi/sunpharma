<section class="bg-primary-gradient"><!-- CONTAINER -->
<div id="mainform-container" class="container py-1 preview">
    <div class="row">
        <!-- FORMS -->
        <div id="mainform-items" class="col-lg-12 mx-0 px-0">
          <div class="progress">
            <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="50"
                    class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                    style="width: 0%; background-color:#f6911f; opacity: .5"></div>
            </div>
            <div id="qbox-container">
                    <div id="steps-container">
                        <div class="step">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question col me-2 d-flex">
                                                <label class="form-check-label question__label noLabel">
                                                    <div class="form-label mb-2"> Photograph of the Applicant</div>
                                                    <img class="uploadPreview" src="<?=$editdata['nominator_photo'];?>" width="200" height="200" />
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Category of the Award</label>
                                        <div ><?=$editdata['category'];?>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Name of the Applicant</label>
                                        <div ><?=$editdata['nominee_name'];?>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Date of Birth</label>
                                        <div ><?=$editdata['date_of_birth'];?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> Citizenship </label>
                                        <div>
                                        <?=$editdata['citizenship'];?>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="step">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Designation & Office Address</label>
                                        <div>
                                            <?=$editdata['designation_and_office_address'];?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Residence Address with Tel/ Cell No.
                                            E-mail</label>
                                            <div>
                                            <?=$editdata['residence_address'];?>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Mobile No.</label>
                                        <div><?=$editdata['mobile_no'];?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Email ID</label>
                                        <div><?=$editdata['email'];?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="step">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Name of the Nominator</label>
                                        <div><?=$editdata['nominator_name'];?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Designation & Office Address of the
                                            Nominator</label>
                                            <div><?=$editdata['nominator_office_address'];?>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Mobile No of the Nominator</label>
                                        <div><?=$editdata['nominator_mobile'];?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Email ID of the Nominator</label>
                                        <div><?=$editdata['nominator_email'];?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> Justification for Sponsoring the
                                            Nomination duly signed by the Nominator (not to exceed 400 words) </label>
                                            <div>
                                                <button class="btn btn-primary btn-sm" type="button">
                                                    <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                    </svg>
                                                        <a href="<?=$editdata['justification_letter'];?>" target="_blank" id="justification_letter_preview">  
                                                          <iframe src="<?=$editdata['justification_letter'];?>" >  View Justification letter </iframe>
                                                        </a>
                                                </button>
                                            </div>
                                    </div>
                                    <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> Passport(Max 1.5 MB) </label>
                                            <div>
                                                <button class="btn btn-primary btn-sm" type="button">
                                                    <svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                        <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                                    </svg>
                                                    <a href="<?=$editdata['passport'];?>" target="_blank" id="passport_preview">
                                                        <iframe src="<?=$editdata['passport'];?>" >
                                                             View Passport
                                                        </iframe>
                                                    </a>
                                                </button>
                                            </div>
                                    </div>
                                </div>

                                </div>
                            </div>
                        </div>

                  <?php if(isset($userdata['role']) && ($userdata['role'] == '2')): ?>      
                        <div class="step">

                            <div class="row">
                               

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">Complete Bio-data of the applicant(Max: 1.5MB) pdf format </label>
                                            <div><button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg>View Publication</button>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for="">  In order of Importance, list of 10
                                            best papers of the applicant highlighting the important
                                            discoveries/contributions described in them briefly (Max. 1 MB)  </label>
                                            <div><button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View Award History</button>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> Statement of Research Achievements, if any, on which any Award has already been Received by the Applicant. Please also upload brief citations on the research works for which the applicant has already received the awards (Max: 1 MB) </label>
                                            <div><button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> Details of the research work</button>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> Signed details of the excellence in
                                            research work for which the Sun Pharma Research Award is claimed, including
                                            references & illustra- tions (Max. 2.5 MB). The candidate should duly sign
                                            on the details </label>
                                            <div><button class="btn btn-primary btn-sm whtext" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View Research Papers</button>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> Two specific publications/research
                                            papers of the applicant relevant to the research work mentioned above (Max.
                                            2.5 MB) </label>
                                            <div><button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View Statement</button>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> A signed statement by the applicant
                                            that the research work under reference has not been given any award. The
                                            applicant should also indicate the extent of the contribution of others
                                            associated with the research and he/she should clearly acknowledge his/her
                                            achievements. (Max. 500 KB) </label>
                                            <div><button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View Statement</button>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 form-items">
                                        <label class="form-label " for=""> Citation on the Research Work of the
                                            Applicant duly signed by the Nominator (Max. 300 KB) </label>
                                            <div><button class="btn btn-primary btn-sm" type="button"><svg class="fs-6" xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor">
                                                <path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"></path>
                                            </svg> View Citation</button>
                                            </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
<input id="acceptTerms" name="acceptTerms" type="checkbox"> 
<label for="acceptTerms">I agree with the Terms and Conditions.</label>
<!-- PRELOADER -->
<div id="preloader-wrapper">
    <div id="preloader"></div>
    <div class="preloader-section section-left"></div>
    <div class="preloader-section section-right"></div>
</div>
</section>