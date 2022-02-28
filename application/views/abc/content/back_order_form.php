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
          <label for="bo_doc_no" class="control-label">Document Number</label>
          <input type="text" name="bo_doc_no" id="bo_doc_no" class="form-control" readonly value="<?= $bo_no ?>">
          <span class="help-block hidden"></span>
        </div>
        <div class="form-group">
          <label for="bo_reg_by" class="control-label">Registered By</label>
          <input type="text" name="bo_reg_by" id="bo_reg_by" class="form-control" readonly value="<?= $this->session->userdata('uid') . ' - ' . $this->session->userdata('uname') ?>">
          <span class="help-block hidden"></span>
        </div>
        <div class="form-group">
          <label for="bo_reg_date" class="control-label">Registered Date</label>
          <input type="date" name="bo_reg_date" id="bo_reg_date" class="form-control" value="<?= date('Y-m-d') ?>">
          <span class="help-block hidden"></span>
        </div>
        <div class="form-group">
          <label for="bo_master_remarks" class="control-label">Remarks</label>
          <textarea name="bo_master_remarks" id="bo_master_remarks" rows="5" class="form-control"></textarea>
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
        <div class="row t-row">
          <div class="col-xs-6">
            <div class="form-group">
              <label for="bo_book[0]" class="control-label">Book</label>
              <select name="bo_book[0]" id="bo_book[0]" class="form-control bo-book">
                <option value=""></option>
              </select>
              <span class="help-block hidden"></span>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="form-group">
              <label for="bo_qty[0]" class="control-label">Qty</label>
              <input type="number" name="bo_qty[0]" id="bo_qty[0]" class="form-control text-right bo-qty" value="0">
              <span class="help-block hidden"></span>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label for="bo_remarks[0]" class="control-label">Remarks</label>
              <textarea name="bo_remarks[0]" id="bo_remarks[0]" rows="2" class="form-control"></textarea>
              <span class="help-block hidden"></span>
            </div>
          </div>
        </div>
      </div>
      <div class="portlet-footer">
        <hr>
        <div class="row">
          <div class="col-md-12 text-right"><a href="#" class="btn blue-chambray add-row">
              <i class="fa fa-plus"></i> Book
            </a></div>
        </div>
      </div>
    </div>
  </div>
</div>