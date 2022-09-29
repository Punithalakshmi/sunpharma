 <!-- page content -->
 <div class="right_col" role="main">
  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Personal Info</h2>
          
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <div class="col-md-7 col-sm-7 col-xs-12">
            <div class="product-image">
              <?php if(isset($user['nominee_id']) && isset($user['nominator_photo'])): ?>
                <img src="<?=base_url()."/uploads/".$user['nominee_id']."/".$user['nominator_photo'];?>" alt="" />
              <?php endif;?>  
            </div>
            <div class="product_gallery">
             
            </div>
          </div>

          <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">

            <h3 class="prod_title"><?=$user['firstname'].' '.$user['lastname'];?></h3>

            <p><?=$user['address'];?></p>
           
       
            <div class="">
              <h5>Email</h5>
              <ul class="list-inline prod_color">
                <li>
                  <p><?=$user['email'];?></p>
                </li>
              </ul>
            </div>
        
            <div class="">
              <h5>Phonenumber</h5>
              <ul class="list-inline prod_color">
                <li><?=$user['phone'];?></li>
              </ul>
            </div>
           
            <div class="">
              <h5>Nominator Name</h5>
              <ul class="list-inline prod_color">
                <li><?=$user['nominator_name'];?></li>
              </ul>
            </div>
            

            <div class="">
              <h5>Nominator Phone</h5>
              <ul class="list-inline prod_color">
                <li><?=$user['nominator_phone'];?></li>
              </ul>
            </div>
            

            <div class="">
              <h5>Nominator Email</h5>
              <ul class="list-inline prod_color">
                <li><?=$user['nominator_email'];?></li>
              </ul>
            </div>
            

            <div class="">
              <h5>Nominator Address</h5>
              <ul class="list-inline prod_color">
                <li><?=$user['nominator_address'];?></li>
              </ul>
            </div>
            <br />

            <div class="">
              <div class="product_price">
                <h2><?=$user['category_name'];?></h2>
                <span>Award Category</span>
                <br>
              </div>
            </div>

            <div class="">
              <button type="button" onclick="nominee_approve('approve','<?=$user['id'];?>');" class="btn btn-primary btn-lg">Approve</button>
            </div>

          </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- /page content -->