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

          <div class="col-md-3 col-xs-12 mt-30">
            <div class="product-image userimgbrder">
              <?php if(isset($user['nominee_id']) && isset($user['nominator_photo'])): ?>
                <img src="<?=base_url()."/uploads/".$user['nominee_id']."/".$user['nominator_photo'];?>" alt="" />
              <?php endif;?>  
            </div>
            <div class="product_gallery">
             
            </div>
          </div>

          <div class="col-md-8 col-xs-12" style="border:0px solid #e5e5e5;">

            <h3 class="prod_title"><?=$user['firstname'].' '.$user['lastname'];?></h3>

            <p><?=$user['address'];?></p>
           
<div class="form-group row formitem">
  <label class="col-sm-3 col-form-label">Email</label>
  <div class="col-sm-9">
      <?=$user['email'];?>
  </div>
</div>

<div class="form-group row formitem">
  <label class="col-sm-3 col-form-label">Phonenumber</label>
  <div class="col-sm-9">
  <?=$user['phone'];?>
  </div>
</div>
       
<div class="form-group row formitem">
  <label class="col-sm-3 col-form-label">Nominator Name</label>
  <div class="col-sm-9">
  <?=$user['nominator_name'];?>
  </div>
</div>

<div class="form-group row formitem">
  <label class="col-sm-3 col-form-label">Nominator Phone</label>
  <div class="col-sm-9">
  <?=$user['nominator_phone'];?>
  </div>
</div>

<div class="form-group row formitem">
  <label class="col-sm-3 col-form-label">Nominator Email</label>
  <div class="col-sm-9">
  <?=$user['nominator_email'];?>
  </div>
</div>
           
<div class="form-group row formitem">
  <label class="col-sm-3 col-form-label">Nominator Address</label>
  <div class="col-sm-9">
  <?=$user['nominator_address'];?>
  </div>
</div>

            

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