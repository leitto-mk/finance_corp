<style>
  td {
    vertical-align: middle !important;
  }

  td>.form-group {
    margin: 0;
  }
</style>

<div class="row">
  <div class="col-lg-4">
    <div class="portlet light" style="margin-bottom: 0;">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">Detail</span>
        </div>
      </div>
      <div class="portlet-body">
        <div class="form-group">
          <label for="bo_receive_doc_no" class="control-label">Document Number</label>
          <input type="text" name="bo_receive_doc_no" id="bo_receive_doc_no" class="form-control" readonly value="<?= $bo_receive_no ?>">
          <span class="help-block hidden"></span>
        </div>
        <div class="form-group">
          <label for="bo_receive_ref_no" class="control-label">Ref. Number</label>
          <input type="text" name="bo_receive_ref_no" id="bo_receive_ref_no" class="form-control" readonly value="<?= $bo_ref_no ?>">
          <span class="help-block hidden"></span>
        </div>
        <div class="form-group">
          <label for="bo_receive_storage" class="control-label">Storage</label>
          <input type="text" name="bo_receive_storage" id="bo_receive_storage" class="form-control" value="">
          <span class="help-block hidden"></span>
        </div>
        <div class="form-group">
          <label for="bo_receive_reg_by" class="control-label">Received By</label>
          <input type="text" name="bo_receive_reg_by" id="bo_receive_reg_by" class="form-control" readonly value="<?= $this->session->userdata('uid') . ' - ' . $this->session->userdata('uname') ?>">
          <span class="help-block hidden"></span>
        </div>
        <div class="form-group">
          <label for="bo_receive_reg_date" class="control-label">Received Date</label>
          <input type="date" name="bo_receive_reg_date" id="bo_receive_reg_date" class="form-control" value="<?= date('Y-m-d') ?>">
          <span class="help-block hidden"></span>
        </div>
        <div class="form-group">
          <label for="bo_receive_master_remarks" class="control-label">Remarks</label>
          <textarea name="bo_receive_master_remarks" id="bo_receive_master_remarks" rows="5" class="form-control"></textarea>
          <span class="help-block hidden"></span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-8">
    <div class="portlet light" style="margin-bottom: 0;">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">Book</span>
        </div>
      </div>
      <div class="portlet-body" id="portlet-book">
        <table class="table table-bordered">
          <thead class="bg-blue-chambray bg-font-blue-chambray">
            <tr>
              <th width="1%" class="text-center">No</th>
              <th width="10%">Stockcode</th>
              <th width="25%">Description</th>
              <th width="5%" class="text-center">UOM</th>
              <th width="5%" class="text-center">Ordered</th>
              <th width="5%" class="text-center">Transferred</th>
              <th width="5%" class="text-center">Received</th>
              <th width="5%" class="text-center">Outstanding</th>
              <th width="5%" class="text-center">Receipt</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($transferred as $row => $value) : ?>
              <tr>
                <td class="text-center">
                  <a href="#" class="btn blue-chambray"><?= $row + 1 ?></a>
                  <input type="hidden" name="bo_receive_item_no[<?= $row ?>]" value="<?= $row + 1 ?>">
                </td>
                <td>
                  <div class="form-group">
                    <input type="hidden" name="bo_receive_stockcode[<?= $row ?>]" id="bo_receive_stockcode[<?= $row ?>]" class="form-control" readonly value="<?= $value['Stockcode'] ?>">
                    <?= $value['Stockcode'] ?>
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <input type="hidden" name="bo_receive_stockdescription[<?= $row ?>]" id="bo_receive_stockdescription[<?= $row ?>]" class="form-control" readonly value="<?= $value['BookName'] ?>">
                    <?= $value['BookName'] ?>
                  </div>
                </td>
                <td class="text-center">
                  <input type="hidden" name="bo_receive_uom[<?= $row ?>]" id="bo_receive_uom[<?= $row ?>]" class="form-control" readonly value="<?= $value['UOM'] ?>">
                  <?= $value['UOM'] ?>
                </td>
                <td class="text-right">
                  <input type="hidden" name="bo_receive_ordered[<?= $row ?>]" id="bo_receive_ordered[<?= $row ?>]" class="form-control" readonly value="<?= $value['Ordered'] ?>">
                  <?= $value['Ordered'] ?>
                </td>
                <td class="text-right">
                  <?= $value['Transferred'] ?>
                </td>
                <td class="text-right">
                  <?= $value['Received'] ?>
                </td>
                <td class="text-right">
                  <?= $value['Transferred'] - $value['Received'] ?>
                </td>
                <td>
                  <div class="form-group">
                    <input type="number" name="bo_receive_qty[<?= $row ?>]" id="bo_receive_qty[<?= $row ?>]" class="form-control text-right" value="0" <?= $value['Transferred'] - $value['Received'] <= 0 ? 'readonly' : '' ?> max="<?= $value['Transferred'] - $value['Received'] ?>">
                    <span class="help-block hidden"></span>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <hr>
        <div class="row">
          <div class="col-lg-12">
            <div class="pull-right">
              <button type="submit" class="btn yellow-casablanca" data-id="<?= $id ?>">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>