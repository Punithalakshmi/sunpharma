<section class="heroInner" style="background: url(&quot;<?=base_url();?>/frontend/assets/img/research-awards.jpg&quot;) center left no-repeat, #fff;">
        <div class="container">
            <h1 class="fs-1 fw-bold fw-normal p-3 m-0 d-inline-block" style="color: var(--theme-orange);">Latest Winners Of Research Fellowships<br></h1>

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
                    <h3 class="heading" style="color: #F7941E;"><?=date('Y')-1;?></h3>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-3 mx-auto" style="max-width: 900px;">
           
            <?php if(is_array($latestWinnersOfResearchAwards) && count($latestWinnersOfResearchAwards) > 0 ): 
                        foreach($latestWinnersOfResearchAwards as $wkey => $wvalue):
                           // $modalname =  str_replace(' ', '', $wvalue['name']); 
                            $modalName = str_replace(".","",$wvalue['name']);
                            $modalName1 = str_replace(",","",$modalName);
                            $modalName1 = str_replace("(","",$modalName1);
                            $modalName1 = str_replace(")","",$modalName1);
                            $modalname = str_replace(" ","",$modalName1);
                            
                            ?>
                        
                        
                <div class="col mb-4">
                    <div class="text-center"><a href="#" data-bs-target="#<?=$modalname;?>" data-bs-toggle="modal">
                        <img class="rounded mb-3 fit-cover" width="150" height="150" src="<?=base_url();?>/uploads/winners/<?=$wvalue['photo'];?>"></a>
                        <a href="#" data-bs-target="#<?=$modalname;?>" data-bs-toggle="modal">
                            <h5 class="fw-bold mb-0"><?=$wvalue['name'];?><br></h5>
                        </a>
                        <p class="text-muted mb-2"><?=$wvalue['category'];?></p>
                        <p class="text-muted mb-2"></p>
                    </div>
                </div>
            <?php endforeach; endif;?>    
                
            </div>
        </div>
    </section>

    <?php if(is_array($latestWinnersOfResearchAwards) && count($latestWinnersOfResearchAwards) > 0 ): 
                        foreach($latestWinnersOfResearchAwards as $wkey => $wvalue): 
                         // $modalname =  str_replace(' ', '', $wvalue['name']);
                          $modalName = str_replace(".","",$wvalue['name']);
                          $modalName1 = str_replace(",","",$modalName);
                          $modalName1 = str_replace("(","",$modalName1);
                          $modalName1 = str_replace(")","",$modalName1);
                          $modalname = str_replace(" ","",$modalName1);

                          ?>
    <div class="modal fade" role="dialog" tabindex="-1" id="<?=$modalname;?>">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?=$wvalue['name'];?><br></h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-6 col-lg-3"><img class="img-fluid mb-3 fit-cover rounded-3" src="<?=base_url();?>/uploads/winners/<?=$wvalue['photo'];?>" style="width: 150px;height: 150px;"></div>
                            <div class="col-md-6 col-lg-9"><p class="fw-bold"><?=$wvalue['name'];?><br></p>
                                <small><?=$wvalue['designation'];?><br>
                                <?=$wvalue['address'];?><br>

<br></small><br></small>
                            </div>
                        </div>
                    </div>
                    <div class="text-start"></div>
                    <p><?=$wvalue['bio'];?><br></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
    <?php endforeach; endif;?>    

    