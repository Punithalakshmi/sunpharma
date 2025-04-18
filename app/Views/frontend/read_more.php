<section class="heroInner" style="background: #fff url(<?=base_url();?>/uploads/events/<?=$eventData['banner_image'];?>) center left no-repeat;">
        <div class="container">
            <h1 class="fs-1 fw-bold text-capitalize fw-normal p-3 m-0 d-inline-block" style="color: var(--theme-orange);"><?php if(!empty($uri_value) && ($uri_value !=14)){?><?=($eventData['title'])?$eventData['title']:'';?><?php }else{?>Book Releasing Ceremony - National Symposium<?php } ?></h1>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>&nbsp;<?=(isset($eventData['description']) && !empty($eventData['description']))?$eventData['description']:'';?><br></p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    
                    <ul class="list-group btnaction" style="max-width: 400px;border-color: var(--bs-blue);">
		<?php if(isset($eventData['agenda']) && !empty($eventData['agenda'])){ ?>
                        <li class="list-group-item" style="border-color: var(--bs-blue);">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -32 576 576" width="1em" height="1em" fill="currentColor" style="font-size: 29px;color: var(--theme-orange);">
                                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M572.1 82.38C569.5 71.59 559.8 64 548.7 64h-100.8c.2422-12.45 .1078-23.7-.1559-33.02C447.3 13.63 433.2 0 415.8 0H160.2C142.8 0 128.7 13.63 128.2 30.98C127.1 40.3 127.8 51.55 128.1 64H27.26C16.16 64 6.537 71.59 3.912 82.38C3.1 85.78-15.71 167.2 37.07 245.9c37.44 55.82 100.6 95.03 187.5 117.4c18.7 4.805 31.41 22.06 31.41 41.37C256 428.5 236.5 448 212.6 448H208c-26.51 0-47.99 21.49-47.99 48c0 8.836 7.163 16 15.1 16h223.1c8.836 0 15.1-7.164 15.1-16c0-26.51-21.48-48-47.99-48h-4.644c-23.86 0-43.36-19.5-43.36-43.35c0-19.31 12.71-36.57 31.41-41.37c86.96-22.34 150.1-61.55 187.5-117.4C591.7 167.2 572.9 85.78 572.1 82.38zM77.41 219.8C49.47 178.6 47.01 135.7 48.38 112h80.39c5.359 59.62 20.35 131.1 57.67 189.1C137.4 281.6 100.9 254.4 77.41 219.8zM498.6 219.8c-23.44 34.6-59.94 61.75-109 81.22C426.9 243.1 441.9 171.6 447.2 112h80.39C528.1 135.7 526.5 178.7 498.6 219.8z"></path>
                            </svg>
                            <a href="<?=base_url();?>/uploads/events/<?=$eventData['agenda'];?>" style="margin-left: 15px;color: var(--bs-blue);font-size: 20px;" target="_blank">Agenda</a></li>
		<?php } ?>
<?php if(isset($eventData['document']) && !empty($eventData['document'])){ ?>
                          <li class="list-group-item" style="font-size: 20px;border-color: var(--bs-blue);">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor" class="fa-2x" style="font-size: 26px;color: var(--theme-orange);">
                                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M88 304H80V256H88C101.3 256 112 266.7 112 280C112 293.3 101.3 304 88 304zM192 256H200C208.8 256 216 263.2 216 272V336C216 344.8 208.8 352 200 352H192V256zM224 0V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64C0 28.65 28.65 0 64 0H224zM64 224C55.16 224 48 231.2 48 240V368C48 376.8 55.16 384 64 384C72.84 384 80 376.8 80 368V336H88C118.9 336 144 310.9 144 280C144 249.1 118.9 224 88 224H64zM160 368C160 376.8 167.2 384 176 384H200C226.5 384 248 362.5 248 336V272C248 245.5 226.5 224 200 224H176C167.2 224 160 231.2 160 240V368zM288 224C279.2 224 272 231.2 272 240V368C272 376.8 279.2 384 288 384C296.8 384 304 376.8 304 368V320H336C344.8 320 352 312.8 352 304C352 295.2 344.8 288 336 288H304V256H336C344.8 256 352 248.8 352 240C352 231.2 344.8 224 336 224H288zM256 0L384 128H256V0z"></path>
                            </svg>
                            <a href="<?=base_url();?>/uploads/events/<?=$eventData['document'];?>" style="margin-left: 15px;color: var(--bs-blue);font-size: 20px;" target="_blank">Poster Invitation</a></li>
<?php } ?>
 <?php if(!empty($uri_value) && ($uri_value !=15)){?>
				 <li class="list-group-item" style="font-size: 20px;border-color: var(--bs-blue);">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor" class="fa-2x" style="font-size: 26px;color: var(--theme-orange);">
                                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M88 304H80V256H88C101.3 256 112 266.7 112 280C112 293.3 101.3 304 88 304zM192 256H200C208.8 256 216 263.2 216 272V336C216 344.8 208.8 352 200 352H192V256zM224 0V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64C0 28.65 28.65 0 64 0H224zM64 224C55.16 224 48 231.2 48 240V368C48 376.8 55.16 384 64 384C72.84 384 80 376.8 80 368V336H88C118.9 336 144 310.9 144 280C144 249.1 118.9 224 88 224H64zM160 368C160 376.8 167.2 384 176 384H200C226.5 384 248 362.5 248 336V272C248 245.5 226.5 224 200 224H176C167.2 224 160 231.2 160 240V368zM288 224C279.2 224 272 231.2 272 240V368C272 376.8 279.2 384 288 384C296.8 384 304 376.8 304 368V320H336C344.8 320 352 312.8 352 304C352 295.2 344.8 288 336 288H304V256H336C344.8 256 352 248.8 352 240C352 231.2 344.8 224 336 224H288zM256 0L384 128H256V0z"></path>
                            </svg>
                            <a href="<?=base_url();?>/uploads/events/Writeup_on_Multiomics.pdf" target="_blank" style="margin-left: 15px;color: var(--bs-blue);font-size: 20px;" target="_blank">Write up on Topic</a></li>
<?php } ?>

			 <li class="list-group-item" style="font-size: 20px;border-color: var(--bs-blue);">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="1em" height="1em" fill="currentColor" class="fa-2x" style="font-size: 26px;color: var(--theme-orange);">
                                                           
				  <path d="M88 304H80V256H88C101.3 256 112 266.7 112 280C112 293.3 101.3 304 88 304zM192 256H200C208.8 256 216 263.2 216 272V336C216 344.8 208.8 352 200 352H192V256zM224 0V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64C0 28.65 28.65 0 64 0H224zM64 224C55.16 224 48 231.2 48 240V368C48 376.8 55.16 384 64 384C72.84 384 80 376.8 80 368V336H88C118.9 336 144 310.9 144 280C144 249.1 118.9 224 88 224H64zM160 368C160 376.8 167.2 384 176 384H200C226.5 384 248 362.5 248 336V272C248 245.5 226.5 224 200 224H176C167.2 224 160 231.2 160 240V368zM288 224C279.2 224 272 231.2 272 240V368C272 376.8 279.2 384 288 384C296.8 384 304 376.8 304 368V320H336C344.8 320 352 312.8 352 304C352 295.2 344.8 288 336 288H304V256H336C344.8 256 352 248.8 352 240C352 231.2 344.8 224 336 224H288zM256 0L384 128H256V0z"></path>

 </svg>
                            <a href="<?=base_url();?>/uploads/events/Flyer_Multiomics_to_Clinics.pdf" style="margin-left: 15px;color: var(--bs-blue);font-size: 20px;" target="_blank">Flyer</a>
	  </li>

                        <?php $current_date = strtotime(date("Y-m-d")); 
                              $eventDate = strtotime(date("Y-m-d",strtotime($eventData['end_date'])));
                              if($eventDate > $current_date):  
                           ?>
                           <!-- <li class="list-group-item" style="font-size: 20px;border-color: var(--bs-blue);">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -32 576 576" width="1em" height="1em" fill="currentColor" class="fa-2x" style="font-size: 26px;color: var(--theme-orange);">
                                                                                <path d="M544 32h-112l-32-32H320c-17.62 0-32 14.38-32 32v160c0 17.62 14.38 32 32 32h224c17.62 0 32-14.38 32-32V64C576 46.38 561.6 32 544 32zM544 320h-112l-32-32H320c-17.62 0-32 14.38-32 32v160c0 17.62 14.38 32 32 32h224c17.62 0 32-14.38 32-32v-128C576 334.4 561.6 320 544 320zM64 16C64 7.125 56.88 0 48 0h-32C7.125 0 0 7.125 0 16V416c0 17.62 14.38 32 32 32h224v-64H64V160h192V96H64V16z"></path>
                                </svg>
                                <a href="<?//base_url();?>/event/registration/<?=$eventData['id'];?>" style="margin-left: 15px;color: var(--bs-blue);font-size: 20px;">
                                    Registration
                                </a>
                            </li>-->
                         <?php endif;?>
                    </ul>
                </div>
                <div class="col-md-6 align-items-center align-items-sm-center">
                   
                </div>
            </div>
        </div>
    </section>

