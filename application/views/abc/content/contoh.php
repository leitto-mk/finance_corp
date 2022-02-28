<style>
  .text-middle {
    vertical-align: middle !important;
  }

  .break-bottom {
    margin-bottom: 10px;
  }
</style>

<div class="portlet light">
  <button class="btn blue break-bottom">
    Coba
  </button>
  <input type="text" name="date_picker" id="date_picker">
  <table class="table table-bordered">
    <thead class="bg-blue-chambray bg-font-blue-chambray">
      <tr>
        <th class="text-center text-middle" rowspan="2">No</th>
        <th class="text-center text-middle" rowspan="2">Month</th>
        <th class="text-center text-middle" rowspan="2">Employee Opening Balance</th>
        <th class="text-center" colspan="2">Employees</th>
        <th class="text-center text-middle" rowspan="2">Closing Balance</th>
        <th class="text-center text-middle" rowspan="2">Turnover Rate</th>
        <th class="text-center text-middle" rowspan="2">Action</th>
      </tr>
      <tr>
        <th class="text-center">Hire</th>
        <th class="text-center">Left</th>
      </tr>
    </thead>
  </table>
</div>
<a class="btn red btn-outline sbold" data-toggle="modal" href="#basic"> View Demo </a>
<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Modal Title</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover" id="table-contoh">
          <thead>
            <tr>
              <th>Header 1</th>
              <th>Header 2</th>
              <th>Header 3</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Data 1</td>
              <td>Data 2</td>
              <td>Data 3.1</td>
            </tr>
            <tr>
              <td>Data 1</td>
              <td>Data 2</td>
              <td>Data 3</td>
            </tr>
            <tr>
              <td>Data 1</td>
              <td>Data 2</td>
              <td>Data 3</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
        <button type="button" class="btn green">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>