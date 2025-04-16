<select class="select2_single form-control col-md-7 col-xs-12" name="category" id="category" tabindex="-1" >
    <option value=""></option>
    <?php if(is_array($categories)):
            foreach($categories as $rvalue): ?>
    <option value="<?=$rvalue['id'];?>" <?=set_select('category',$rvalue['id'],(isset($editdata['category']) && ($editdata['category']==$rvalue['id']))?true:false);?>><?=$rvalue['name'];?></option>
    <?php endforeach;
            endif;
            ?>
</select>