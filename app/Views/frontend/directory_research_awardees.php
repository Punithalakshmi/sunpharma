 <section class="heroInner" style="background: url(&quot;<?=base_url();?>/frontend/assets/img/directory-winner.jpg&quot;) top no-repeat, #fff;">
        <div class="container">
            <h1 class="fs-1 fw-bold text-capitalize fw-normal p-3 m-0 d-inline-block" style="color: var(--theme-orange);">Research Award Winners<br></h1>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12"></div>
            </div>
        </div>
        <?php if(is_array($awardees)): 
               foreach($awardees as $akey=>$avalue): ?>
        <div class="container olddirectory" style="/*margin-bottom: 60px;*/">
            <div class="row row-cols-1 row-cols-md-4">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h3 class="heading" style="color: #F7941E;"><?=$akey;?><br></h3>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-4 mx-auto justify-content-center" style="max-width: 900px;">
                <?php foreach($avalue as $k => $v): ?>
                <div class="col mb-4">
                    <div class="text-center"><a href="#" data-bs-target="#<?=$v['modalname'];?>" data-bs-toggle="modal"><img class="rounded mb-3 fit-cover" width="150" height="150" src="<?=base_url();?>/uploads/winners/<?=$v['photo'];?>"></a>
                    <a href="#" data-bs-target="#<?=$v['modalname'];?>" data-bs-toggle="modal">
                            <h5 class="fw-bold mb-0"><?=$v['name'];?><br></h5>
                        </a>
                        <p class="text-muted mb-2"><?=$v['category'];?>&nbsp;</p>
                        <p class="text-muted mb-2"></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; endif;?>
       
            <div class="row d-lg-flex mx-auto justify-content-lg-center" style="max-width: 900px;">
                <div class="col-auto mb-4"><a href="<?=base_url();?>/frontend/assets/pdf/Directory of Previous Research Award Winners.pdf" target="_blank"><button class="btn btn-primary btn-lg" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor" class="fs-2">
                                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M88 304H80V256H88C101.3 256 112 266.7 112 280C112 293.3 101.3 304 88 304zM192 256H200C208.8 256 216 263.2 216 272V336C216 344.8 208.8 352 200 352H192V256zM224 0V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64C0 28.65 28.65 0 64 0H224zM64 224C55.16 224 48 231.2 48 240V368C48 376.8 55.16 384 64 384C72.84 384 80 376.8 80 368V336H88C118.9 336 144 310.9 144 280C144 249.1 118.9 224 88 224H64zM160 368C160 376.8 167.2 384 176 384H200C226.5 384 248 362.5 248 336V272C248 245.5 226.5 224 200 224H176C167.2 224 160 231.2 160 240V368zM288 224C279.2 224 272 231.2 272 240V368C272 376.8 279.2 384 288 384C296.8 384 304 376.8 304 368V320H336C344.8 320 352 312.8 352 304C352 295.2 344.8 288 336 288H304V256H336C344.8 256 352 248.8 352 240C352 231.2 344.8 224 336 224H288zM256 0L384 128H256V0z"></path>
                            </svg>&nbsp;Download Research Awards Directory</button></a></div>
            </div>
        </div>
    </section>

    <?php if(is_array($rawards)): 
               foreach($rawards as $akey=>$avalue):
                           ?>
    <div class="modal fade" role="dialog" tabindex="-1" id="<?=$avalue['modalname'];?>">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?=$avalue['name'];?><br></h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-6 col-lg-3"><img class="img-fluid mb-3 fit-cover rounded-3" src="<?=base_url();?>/uploads/winners/<?=$avalue['photo'];?>" style="width: 150px;height: 150px;"></div>
                            <div class="col-md-6 col-lg-9">
                                <p class="fw-bold"><?=$avalue['name'];?><br></p><small><?=$avalue['designation'];?>,<br><?=$avalue['address'];?><br><br></small>
                            </div>
                        </div>
                    </div>
                    <div class="text-start"></div>
                    <p><?=$avalue['bio'];?><br></p>
                </div>
                <div class="modal-footer"><button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
<?php endforeach; endif; ?>
    