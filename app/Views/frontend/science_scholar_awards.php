<section class="heroInner" style="background: url('<?=base_url();?>/frontend/assets/img/science-scholar-award-tbanner.jpg') top no-repeat, #fff;">
        <div class="container">
            <h1 class="fs-1 fw-bold text-capitalize fw-normal p-3 m-0 d-inline-block" style="color: var(--theme-orange);">Science Scholar Awards</h1>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                    <p>The Science Scholar Awards for Young Scientists aims to discover brilliant and upcoming young researchers in Bio-medical and Pharmaceutical Sciences. These awards are meant to stimulate the young minds to pursue research as a career by way of soliciting commitment for the cause of future advancement of science. Each Science Scholar Award carry a certificate and a Cash Prize of Rupees fifty thousand. In addition to this, rupees fifty thousand will be provided to the science scholar awardees for attending an international conference to present abstracts/Posters. To avail this additional amount, the awardee should submit the invitation letter from the conference organizing committee and also expense details with documentary proof to the office of the foundation.<br></p>
                
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group btnaction" style="max-width: 400px;border-color: var(--bs-blue);">
                        <li class="list-group-item" style="font-size: 20px;border-color: var(--bs-blue);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor" class="fa-2x" style="font-size: 26px;color: var(--theme-orange);">
                                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M88 304H80V256H88C101.3 256 112 266.7 112 280C112 293.3 101.3 304 88 304zM192 256H200C208.8 256 216 263.2 216 272V336C216 344.8 208.8 352 200 352H192V256zM224 0V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64C0 28.65 28.65 0 64 0H224zM64 224C55.16 224 48 231.2 48 240V368C48 376.8 55.16 384 64 384C72.84 384 80 376.8 80 368V336H88C118.9 336 144 310.9 144 280C144 249.1 118.9 224 88 224H64zM160 368C160 376.8 167.2 384 176 384H200C226.5 384 248 362.5 248 336V272C248 245.5 226.5 224 200 224H176C167.2 224 160 231.2 160 240V368zM288 224C279.2 224 272 231.2 272 240V368C272 376.8 279.2 384 288 384C296.8 384 304 376.8 304 368V320H336C344.8 320 352 312.8 352 304C352 295.2 344.8 288 336 288H304V256H336C344.8 256 352 248.8 352 240C352 231.2 344.8 224 336 224H288zM256 0L384 128H256V0z"></path>
                            </svg><a href="https://sunpharmasciencefoundation.net/documents/SA_Eligibility%20%20Nomination%20Procedure.pdf" style="margin-left: 15px;color: var(--bs-blue);font-size: 20px;" target="_blank">Eligibility and Nomination Procedure</a></li>
                        <li class="list-group-item" style="font-size: 20px;border-color: var(--bs-blue);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -32 576 576" width="1em" height="1em" fill="currentColor" class="fa-2x" style="font-size: 26px;color: var(--theme-orange);">
                                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M544 32h-112l-32-32H320c-17.62 0-32 14.38-32 32v160c0 17.62 14.38 32 32 32h224c17.62 0 32-14.38 32-32V64C576 46.38 561.6 32 544 32zM544 320h-112l-32-32H320c-17.62 0-32 14.38-32 32v160c0 17.62 14.38 32 32 32h224c17.62 0 32-14.38 32-32v-128C576 334.4 561.6 320 544 320zM64 16C64 7.125 56.88 0 48 0h-32C7.125 0 0 7.125 0 16V416c0 17.62 14.38 32 32 32h224v-64H64V160h192V96H64V16z"></path>
                            </svg><a href="<?=base_url();?>/directory_of_science_scholars" style="margin-left: 15px;color: var(--bs-blue);font-size: 20px;">Directory of Previous Awardees</a></li>
                    </ul>
                </div>
                <?php
                         $view = true;
                        if(isset($userdata['isLoggedIn']) && $userdata['isLoggedIn']){
                                $url = base_url().'/view/'.$userdata['id'];
                                $view = true;
                        }    
                        else
                        {
                            $url = base_url().'/spsfn'; 
                            $view = (!isset($userdata['isLoggedIn']) && (isset($currentNominations['science_scholars_awards']) && $currentNominations['science_scholars_awards'] == 'yes'))?true:false;
                        }    
                        if($view)
                        {
                    ?>
                    <div class="col-md-6">
                        <a href="<?=$url;?>"><button class="btn btn-primary btn-lg" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" class="fs-2">
                                    <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                    <path d="M511.6 36.86l-64 415.1c-1.5 9.734-7.375 18.22-15.97 23.05c-4.844 2.719-10.27 4.097-15.68 4.097c-4.188 0-8.319-.8154-12.29-2.472l-122.6-51.1l-50.86 76.29C226.3 508.5 219.8 512 212.8 512C201.3 512 192 502.7 192 491.2v-96.18c0-7.115 2.372-14.03 6.742-19.64L416 96l-293.7 264.3L19.69 317.5C8.438 312.8 .8125 302.2 .0625 289.1s5.469-23.72 16.06-29.77l448-255.1c10.69-6.109 23.88-5.547 34 1.406S513.5 24.72 511.6 36.86z"></path>
                                </svg>&nbsp;Submit Nomination</button></a></div>
                    </div>
                    <?php } ?>
        </div>


        <div id="awardslist" class="container mt-5">
        <div class="row">
            <div class="col-md-12">
            <section class="border tabWrapper">
                        <div class="tabFilter">
                            <ul class="nav nav-tabs bg-orange pt-3 px-3" role="tablist">
                                <li class="nav-item" role="presentation"><a class="nav-link active" role="tab" data-bs-toggle="tab" href="#tab-1">Bio-Medical Sciences</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-2">Pharmaceutical Sciences</a></li>
                               
                            </ul>
                            <div class="tab-content">
<div class="tab-pane active" role="tabpanel" id="tab-1">
<h2>Bio-Medical Sciences</h2>
<!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
</p> -->

<p class="text-center"><a href="#">
<button class="btn btn-primary btn-lg" type="button">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" class="fs-2">
        <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
        <path d="M511.6 36.86l-64 415.1c-1.5 9.734-7.375 18.22-15.97 23.05c-4.844 2.719-10.27 4.097-15.68 4.097c-4.188 0-8.319-.8154-12.29-2.472l-122.6-51.1l-50.86 76.29C226.3 508.5 219.8 512 212.8 512C201.3 512 192 502.7 192 491.2v-96.18c0-7.115 2.372-14.03 6.742-19.64L416 96l-293.7 264.3L19.69 317.5C8.438 312.8 .8125 302.2 .0625 289.1s5.469-23.72 16.06-29.77l448-255.1c10.69-6.109 23.88-5.547 34 1.406S513.5 24.72 511.6 36.86z"></path>
</svg>&nbsp;Submit Nomination</button>
</a></p>
</div>

  <div class="tab-pane" role="tabpanel" id="tab-2">
  <h2>Pharmaceutical Sciences</h2>
<!-- <p>Demo text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
</p> -->

<p class="text-center"><a href="#">
<button class="btn btn-primary btn-lg" type="button">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" class="fs-2">
        <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
        <path d="M511.6 36.86l-64 415.1c-1.5 9.734-7.375 18.22-15.97 23.05c-4.844 2.719-10.27 4.097-15.68 4.097c-4.188 0-8.319-.8154-12.29-2.472l-122.6-51.1l-50.86 76.29C226.3 508.5 219.8 512 212.8 512C201.3 512 192 502.7 192 491.2v-96.18c0-7.115 2.372-14.03 6.742-19.64L416 96l-293.7 264.3L19.69 317.5C8.438 312.8 .8125 302.2 .0625 289.1s5.469-23.72 16.06-29.77l448-255.1c10.69-6.109 23.88-5.547 34 1.406S513.5 24.72 511.6 36.86z"></path>
</svg>&nbsp;Submit Nomination</button>
</a></p>

</div>


</div>
                               
   </div>
                        </div>
                    </section>
            </div>
        </div>
     </div>


    </section>