<div class="row">
  <div class="col-lg-2">
    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">Parameter</span>
        </div>
      </div>
      <div class="portlet-body form">
        <div class="form-body">
          <div class="form-group">
            <label for="date-range" class="control-label">Date Range</label>
            <input type="text" name="date-range" id="date-range" class="form-control" placeholder="Select Date Range" readonly style="cursor: pointer;">
            <span class="help-block font-green">Select Range to See the report</span>
          </div>
          <div class="form-group">
            <label for="param-employee" class="control-label">Penginjil Literatur</label>
            <select name="param-employee" id="param-employee" class="form-control">
              <option value="">Penginjil Literatur 1</option>
              <option value="">Penginjil Literatur 2</option>
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-10">
    <div class="portlet light bg-font-white">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">Report</span>
          <span class="caption-helper" id="portlet-report"></span>
        </div>
      </div>
      <div class="portlet-body">
        <?php $this->load->view('abc/component/table_le_sales_detail') ?>
      </div>
    </div>
  </div>
</div>