<div class="right_col" role="main" style="min-height: 246px;">
  <div class="">
    <div class="page-title">
      <div class="title_left ml-3" style="width:100%;">
        <h3>Jury mapping with Fellowships</h3>
      </div>
    </div>

    <div class="clearfix"></div>
    <form method="POST" name="jury_mapping" class="form-horizontal" action="<?= base_url(); ?>/admin/jury/mapping">
      <?= csrf_field(); ?>
      <div class="d-flex flex-column">
        <div class="col-md-12 d-flex justify-content-center align-items-center flex-column">

          <div class="jurymap x_panel" style="min-height:400px;">
            <div class="jurymaplist">
              <label>Jury :</label>

              <select class="selectpicker" name="jury">
                <?php if (count($juryLists)) :
                  foreach ($juryLists as $jkey => $jvalue) : ?>
                    <option value="<?= $jvalue['id']; ?>"><?= $jvalue['firstname'] . ' ' . $jvalue['lastname']; ?></option>
                <?php endforeach;
                endif; ?>
              </select>
            </div>

            <div class="jurymaplist">
              <label>Fellowship Type* :</label>
              <select class="selectpicker" multiple name="award[]">
                <?php if (count($awardLists)) :
                  foreach ($awardLists as $akey => $avalue) : ?>
                    <option value="<?= $avalue['id']; ?>"><?= $avalue['title']; ?></option>
                <?php endforeach;
                endif; ?>
              </select>
            </div>

            <div class="jurymaplist">
              <label></label> <input type="submit" class="btn btn-success" name="jurymap_submit" value="ASSIGN">
            </div>

            <div class="clearfix"></div>


            <div class="errormsg justify-content-center flex-column">

              <div class="col-md-12 d-flex justify-content-center align-items-center">
                <?php if (isset($validation) && $validation->getError('jury')) { ?>
                  <div class='alert alert-danger mt-2'>
                    <?= $error = $validation->getError('jury'); ?>
                  </div>
                <?php } ?>
              </div>
              <div class="col-md-12 d-flex justify-content-center align-items-center">
                <?php if (isset($validation) && $validation->getError('award')) { ?>
                  <div class='alert alert-danger mt-2'>
                    <?= $error = $validation->getError('award'); ?>
                  </div>
                <?php } ?>
              </div>
            </div>

          </div>



          <style>
            .jurymapping .bootstrap-select .dropdown-menu.inner {
              font-size: 16px;
            }

            .jurymap .bootstrap-select .dropdown-toggle .filter-option-inner-inner {
              font-size: 14px;
            }

            .jurymapping .btn {
              border: 1px solid;
            }

            .jurymapping .bootstrap-select {
              width: 100% !important;
            }

            .bootstrap-select.show-tick .dropdown-menu .selected span.check-mark {
              color: #f7941e;
            }

            .dropdown-item.active,
            .dropdown-item:active {
              background: #047cb2;
            }

            .minhight {
              min-height: 580px;
            }

            .jurymap {
              padding-top: 20px;
              display: flex;
              flex-direction: column;
              align-items: center;
              justify-content: center;
            }

            .jurymap label {
              min-width: 140px;
              font-size: 16px;
              color: black;
              font-weight: 500;
            }

            .jurymap .jurymaplist {
              margin-bottom: 10px;
              width: 100%;
              margin-top: 10px;
              max-width: 460px;
            }
            .jurymap .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
              width: 300px;
              }

            .jurymap span.text {
              font-size: 14px;
              padding: 3px;
            }

            .bootstrap-select .dropdown-toggle .filter-option {
              border: 1px solid #888;
              border-radius: 4px;
            }
          </style>



        </div>




    </form>

    <!-- Footer Menu -->



  </div>
</div>